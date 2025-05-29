<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\HomeNews;
use Illuminate\Http\Request;
use App\Models\Produk\Buletin;
use App\Models\Produk\Majalah;
use App\Models\Karya\Puisi;
use App\Models\Karya\Pantun;
use App\Models\Karya\Syair;
use App\Models\Karya\Fotografi;
use App\Models\Karya\DesainGrafis;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Reaksi;
use App\Models\UserReact\Komentar;

class HomeNewsController extends Controller
{
    /**
     * Tampilkan daftar berita di homepage atau kategori tertentu
     */
    public function index(Request $request, $category = null)
    {
        if (!$category) {
            $news = HomeNews::where('visibilitas', 'public')
                ->orderBy('tanggal_diterbitkan', 'desc')
                ->take(10)
                ->get();

            $newsList = (new HomeNews)->getBeritaTeratasHariIni();

            $sliderNews = HomeNews::where('visibilitas', 'public')
                ->orderBy('tanggal_diterbitkan', 'desc')
                ->take(10)
                ->get();

            $puisiList = Puisi::withCount('reaksiSuka')
                ->where('kategori', 'puisi')
                ->where('visibilitas', 'public')
                ->orderByDesc('reaksi_suka_count')
                ->orderByDesc('view_count')
                ->orderByDesc('release_date')
                ->take(6)
                ->get();

            $pantunList = Pantun::withCount('reaksiSuka')
                ->where('kategori', 'pantun')
                ->where('visibilitas', 'public')
                ->orderByDesc('reaksi_suka_count')
                ->orderByDesc('view_count')
                ->orderByDesc('release_date')
                ->take(6)
                ->get();

            $syairList = Syair::withCount('reaksiSuka')
                ->where('kategori', 'syair')
                ->where('visibilitas', 'public')
                ->orderByDesc('reaksi_suka_count')
                ->orderByDesc('view_count')
                ->orderByDesc('release_date')
                ->take(6)
                ->get();

            $totalFotografiCount = Fotografi::where('kategori', 'fotografi')
                ->where('visibilitas', 'public')
                ->count();

            $fotografiList = Fotografi::withCount('reaksiSuka')
                ->where('kategori', 'fotografi')
                ->where('visibilitas', 'public')
                ->orderByDesc('reaksi_suka_count')
                ->orderByDesc('view_count')
                ->orderByDesc('release_date')
                ->take(9)
                ->get();

            $totalDesainGrafisCount = DesainGrafis::where('kategori', 'desain_grafis')
                ->where('visibilitas', 'public')
                ->count();

            $desainGrafisList = DesainGrafis::withCount('reaksiSuka')
                ->where('kategori', 'desain_grafis')
                ->where('visibilitas', 'public')
                ->orderByDesc('reaksi_suka_count')
                ->orderByDesc('view_count')
                ->orderByDesc('release_date')
                ->take(9)
                ->get();

            // Ambil data buletin & majalah
            $buletinList = Buletin::getHomeBuletin();
            $majalahList = Majalah::getHomeMajalah();

            return view('home', compact('news', 'newsList', 'sliderNews', 'buletinList', 'majalahList', 'puisiList', 'pantunList', 'syairList', 'totalFotografiCount', 'fotografiList', 'desainGrafisList', 'totalDesainGrafisCount'));
        }

        $news = HomeNews::where('kategori', str_replace('-', ' ', $category))
            ->where('visibilitas', 'public')
            ->orderBy('tanggal_diterbitkan', 'desc')
            ->paginate(10);

        return view('kategori.news-list', compact('news', 'category'));
    }

    private function getKaryaByCategory($category)
    {
        switch ($category) {
            case 'puisi':
                return Puisi::where('kategori', 'puisi')->orderBy('release_date', 'desc')->take(6)->get();
            case 'pantun':
                return Pantun::where('kategori', 'pantun')->orderBy('release_date', 'desc')->take(6)->get();
            case 'syair':
                return Syair::where('kategori', 'syair')->orderBy('release_date', 'desc')->take(6)->get();
            case 'fotografi':
                return Fotografi::where('kategori', 'fotografi')->orderBy('release_date', 'desc')->take(6)->get();
            case 'desain_grafis':
                return DesainGrafis::where('kategori', 'desain_grafis')->orderBy('release_date', 'desc')->take(6)->get();
            default:
                return [];
        }
    }

    /**
     * Tampilkan detail berita
     */
    public function show(Request $request)
    {
        $newsId = $request->query('a');
        $news = HomeNews::where('id', $newsId)->firstOrFail();
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
            ->whereNull('parent_id')
            ->orderBy('tanggal_komentar', 'desc')
            ->get();

        // RELATED NEWS: view_count + tanggal terbaru
        $relatedNews = HomeNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->where('visibilitas', 'public')
            ->orderByDesc('view_count')
            ->orderByDesc('tanggal_diterbitkan')
            ->take(6)
            ->get();

        // RECOMMENDED NEWS: suka_count + view_count + tanggal terbaru
        $recommendedNews = HomeNews::where('id', '!=', $news->id)
            ->where('kategori', $news->kategori)
            ->where('visibilitas', 'public')
            ->withCount([
                'reaksi as suka_count' => function ($query) {
                    $query->where('jenis_reaksi', 'Suka');
                }
            ])
            ->orderByDesc('suka_count')
            ->orderByDesc('view_count')
            ->orderByDesc('tanggal_diterbitkan')
            ->take(6)
            ->get();

        // OTHER TOPICS: kategori acak, lalu view_count + suka_count + tanggal
        $randomKategori = HomeNews::where('kategori', '!=', $news->kategori)
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->value('kategori');

        $otherTopics = HomeNews::where('kategori', $randomKategori)
            ->where('visibilitas', 'public')
            ->withCount([
                'reaksi as suka_count' => function ($query) {
                    $query->where('jenis_reaksi', 'Suka');
                }
            ])
            ->orderByDesc('view_count')
            ->orderByDesc('suka_count')
            ->orderByDesc('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics', 'likeCount', 'dislikeCount', 'userReaksi', 'komentarList'));
    }
}
