<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\KesenianHiburanNews;
use Illuminate\Http\Request;
use App\Models\UserReact\Reaksi;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Komentar;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KesenianHiburanNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Kesenian dan Hiburan.
     */
    public function index()
    {
        $terbaru = KesenianHiburanNews::with('user')
            ->whereIn('kategori', ['Kesenian', 'Hiburan'])
            ->withCount([
                'reaksiSuka as like_count'
            ])
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $oneWeekAgo = Carbon::now()->subWeek();

        $rekomendasi = KesenianHiburanNews::with('user')
            ->whereIn('kategori', ['Kesenian', 'Hiburan'])
            ->where('visibilitas', 'public')
            ->select('berita.*', DB::raw("
        (
            berita.view_count +
            (
                SELECT COUNT(*)
                FROM reaksi
                WHERE reaksi.item_id = berita.id
                  AND reaksi.jenis_reaksi = 'Suka'
                  AND reaksi.reaksi_type = 'Berita'
            )
        ) as total_interaksi
    "))
            ->orderByRaw("
        CASE
            WHEN tanggal_diterbitkan >= ? THEN 0
            ELSE 1
        END, total_interaksi DESC
    ", [$oneWeekAgo])
            ->take(8)
            ->get();

        $oneWeekAgo = Carbon::now()->subWeek()->toDateTimeString();

        function getPopularNews($kategori)
        {
            global $oneWeekAgo;

            $baseQuery = DB::table('berita')
                ->leftJoin('user', 'user.uid', '=', 'berita.user_id')
                ->leftJoin('komentar as km', function ($join) {
                    $join->on('berita.id', '=', 'km.item_id')
                        ->where('km.komentar_type', '=', 'Berita');
                })
                ->leftJoin('reaksi as rk', function ($join) {
                    $join->on('berita.id', '=', 'rk.item_id')
                        ->where('rk.reaksi_type', '=', 'Berita')
                        ->where('rk.jenis_reaksi', '=', 'Suka');
                })
                ->where('berita.kategori', $kategori)
                ->where('berita.visibilitas', 'public')
                ->whereRaw("CAST(berita.tanggal_diterbitkan AS DATETIME) >= ?", [$oneWeekAgo])
                ->groupBy('berita.id')
                ->select(
                    'berita.*',
                    'user.nama_lengkap as user_nama_lengkap',
                    DB::raw('COUNT(DISTINCT rk.id) as like_count'),
                    DB::raw('COUNT(DISTINCT km.id) as komentar_count'),
                    DB::raw('(berita.view_count + COUNT(DISTINCT rk.id) + COUNT(DISTINCT km.id)) as total_score')
                )
                ->orderByDesc('total_score')
                ->take(5);

            $result = $baseQuery->get();

            if ($result->isEmpty()) {
                $fallbackQuery = DB::table('berita')
                    ->leftJoin('user', 'user.uid', '=', 'berita.user_id')
                    ->leftJoin('komentar as km', function ($join) {
                        $join->on('berita.id', '=', 'km.item_id')
                            ->where('km.komentar_type', '=', 'Berita');
                    })
                    ->leftJoin('reaksi as rk', function ($join) {
                        $join->on('berita.id', '=', 'rk.item_id')
                            ->where('rk.reaksi_type', '=', 'Berita')
                            ->where('rk.jenis_reaksi', '=', 'Suka');
                    })
                    ->where('berita.kategori', $kategori)
                    ->where('berita.visibilitas', 'public')
                    ->groupBy('berita.id')
                    ->select(
                        'berita.*',
                        'user.nama_lengkap as user_nama_lengkap',
                        DB::raw('COUNT(DISTINCT rk.id) as like_count'),
                        DB::raw('COUNT(DISTINCT km.id) as komentar_count'),
                        DB::raw('(berita.view_count + COUNT(DISTINCT rk.id) + COUNT(DISTINCT km.id)) as total_score')
                    )
                    ->orderByDesc('total_score')
                    ->take(5);

                $result = $fallbackQuery->get();
            }

            return $result->map(function ($item) {
                // Extract first image from konten_berita
                preg_match('/<img[^>]+src="([^">]+)"/i', $item->konten_berita, $matches);
                $item->first_image = $matches[1] ?? 'https://via.placeholder.com/400x200';

                // Buat properti user sebagai object agar mirip relasi
                $item->user = (object)[
                    'nama_lengkap' => $item->user_nama_lengkap ?? '-'
                ];

                return $item;
            });
        }

        $terpopuler_kesenian = getPopularNews('Kesenian');
        $terpopuler_hiburan = getPopularNews('Hiburan');

        return view('kategori.kesenianHiburan', compact(
            'terbaru',
            'rekomendasi',
            'terpopuler_kesenian',
            'terpopuler_hiburan'
        ));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        $newsId = $request->query('a');
        $news = KesenianHiburanNews::where('id', $newsId)->firstOrFail();
        $news->increment('view_count');

        $likeCount = Reaksi::where('item_id', $news->id)
            ->where('jenis_reaksi', 'Suka')
            ->count();

        $dislikeCount = Reaksi::where('item_id', $news->id)
            ->where('jenis_reaksi', 'Tidak Suka')
            ->count();

        $userReaksi = null;
        if (Auth::check()) {
            $userReaksi = Reaksi::where('user_id', Auth::user()->uid)
                ->where('item_id', $news->id)
                ->where('reaksi_type', 'Berita')
                ->first();
        }

        $komentarList = Komentar::with(['user', 'replies.user'])
            ->where('komentar_type', 'Berita')
            ->where('item_id', $news->id)
            ->whereNull('parent_id') // hanya komentar utama
            ->orderBy('tanggal_komentar', 'desc')
            ->get();

        $relatedNews = KesenianHiburanNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->where('visibilitas', 'public')
            ->orderByDesc('view_count')
            ->orderByDesc('tanggal_diterbitkan')
            ->take(6)
            ->get();

        $recommendedNews = KesenianHiburanNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->where('visibilitas', 'public')
            ->withCount([
                'reaksiSuka as suka_count'
            ])
            ->orderByDesc('suka_count')
            ->orderByDesc('view_count')
            ->orderByDesc('tanggal_diterbitkan')
            ->take(6)
            ->get();

        $randomKategori = KesenianHiburanNews::where('kategori', '!=', $news->kategori)
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->value('kategori');

        $otherTopics = KesenianHiburanNews::where('kategori', $randomKategori)
            ->where('visibilitas', 'public')
            ->withCount([
                'reaksiSuka as suka_count'
            ])
            ->orderByDesc('view_count')
            ->orderByDesc('suka_count')
            ->orderByDesc('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics', 'likeCount', 'dislikeCount', 'userReaksi', 'komentarList'));
    }
}
