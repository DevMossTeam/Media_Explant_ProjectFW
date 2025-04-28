<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\KesenianHiburanNews;
use Illuminate\Http\Request;
use App\Models\UserReact\Reaksi;

class KesenianHiburanNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Kesenian dan Hiburan.
     */
    public function index()
    {
        $terbaru = KesenianHiburanNews::with('user')
            ->whereIn('kategori', ['Kesenian', 'Hiburan'])
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $rekomendasi = KesenianHiburanNews::with('user')
            ->whereIn('kategori', ['Kesenian', 'Hiburan'])
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        $terpopuler_kesenian = KesenianHiburanNews::with('user')
            ->where('kategori', 'Kesenian')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(5)
            ->get();

        $terpopuler_hiburan = KesenianHiburanNews::with('user')
            ->where('kategori', 'Hiburan')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(5)
            ->get();

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

        $likeCount = Reaksi::where('item_id', $news->id)
            ->where('jenis_reaksi', 'Suka')
            ->count();

        $dislikeCount = Reaksi::where('item_id', $news->id)
            ->where('jenis_reaksi', 'Tidak Suka')
            ->count();

        // Berita terkait berdasarkan kategori yang sama
        $relatedNews = KesenianHiburanNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->latest('tanggal_diterbitkan')
            ->take(6)
            ->get();

        // Berita rekomendasi (bisa gunakan kriteria lain)
        $recommendedNews = KesenianHiburanNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        // Topik lainnya (berita dari kategori berbeda)
        $otherTopics = KesenianHiburanNews::where('kategori', '!=', $news->kategori)
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics'));
    }
}
