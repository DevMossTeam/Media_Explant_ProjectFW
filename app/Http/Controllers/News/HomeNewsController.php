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

            $puisiList = Puisi::where('kategori', 'puisi')
                ->where('visibilitas', 'public')
                ->orderBy('release_date', 'desc')
                ->take(6)
                ->get();

            $pantunList = Pantun::where('kategori', 'pantun')
                ->where('visibilitas', 'public')
                ->orderBy('release_date', 'desc')
                ->take(6)
                ->get();

            $syairList = Syair::where('kategori', 'syair')
                ->where('visibilitas', 'public')
                ->orderBy('release_date', 'desc')
                ->take(6)
                ->get();

            $fotografiList = Fotografi::where('kategori', 'fotografi')
                ->where('visibilitas', 'public')
                ->orderBy('release_date', 'desc')
                ->take(6)
                ->get();

            $desainGrafisList = DesainGrafis::where('kategori', 'desain_grafis')
                ->where('visibilitas', 'public')
                ->orderBy('release_date', 'desc')
                ->take(6)
                ->get();

            // Ambil data buletin & majalah
            $buletinList = Buletin::getHomeBuletin();
            $majalahList = Majalah::getHomeMajalah();

            return view('home', compact('news', 'newsList', 'buletinList', 'majalahList', 'puisiList', 'pantunList', 'syairList', 'fotografiList', 'desainGrafisList'));
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
    public function show(Request $request, $category)
    {
        $news = HomeNews::where('id', $request->a)->firstOrFail();
        return view('kategori.news-detail', compact('news'));
    }
}
