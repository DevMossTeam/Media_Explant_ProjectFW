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
        // Jika tidak ada kategori, tampilkan homepage dengan semua berita
        if (!$category) {
            $news = HomeNews::where('visibilitas', 'public')
                ->orderBy('tanggal_diterbitkan', 'desc')
                ->paginate(10);
            return view('home', compact('news'));
        }

        // Daftar kategori yang valid
        $validCategories = ['siaran-pers', 'riset', 'wawancara', 'diskusi', 'agenda', 'sastra', 'opini'];

        // Jika kategori tidak valid, tampilkan 404
        if (!in_array($category, $validCategories)) {
            abort(404);
        }

        // Ambil berita berdasarkan kategori
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
        // Ambil ID dari parameter "a"
        $news = HomeNews::where('id', $request->a)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
