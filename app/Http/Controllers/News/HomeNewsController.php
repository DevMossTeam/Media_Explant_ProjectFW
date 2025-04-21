<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\HomeNews;
use Illuminate\Http\Request;

class HomeNewsController extends Controller
{
    /**
     * Tampilkan daftar berita di homepage atau kategori tertentu
     */
    public function index(Request $request, $category = null)
    {
        // Jika tidak ada kategori, tampilkan homepage
        if (!$category) {
            $news = HomeNews::where('visibilitas', 'public')
                ->orderBy('tanggal_diterbitkan', 'desc')
                ->take(10)
                ->get();

            // Ambil berita teratas berdasarkan kategori untuk ditampilkan di bagian "Berita Teratas Hari Ini"
            $newsList = (new HomeNews)->getBeritaTeratasHariIni();

            return view('home', compact('news', 'newsList'));
        }

        // Daftar kategori yang valid
        $validCategories = ['siaran-pers', 'riset', 'wawancara', 'diskusi', 'agenda', 'sastra', 'opini'];

        if (!in_array($category, $validCategories)) {
            abort(404);
        }

        $news = HomeNews::where('kategori', str_replace('-', ' ', $category))
            ->where('visibilitas', 'public')
            ->orderBy('tanggal_diterbitkan', 'desc')
            ->paginate(10);

        return view('kategori.news-list', compact('news', 'category'));
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
