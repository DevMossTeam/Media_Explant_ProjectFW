<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\RisetNews;
use Illuminate\Http\Request;

class RisetNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Riset.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Riset' dan visibilitas 'public'
        $news = RisetNews::where('kategori', 'Riset')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.riset', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = RisetNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
