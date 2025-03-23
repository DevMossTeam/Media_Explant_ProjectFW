<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\NasionalNews;
use Illuminate\Http\Request;

class NasionalNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Nasional.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Nasional' dan visibilitas 'public'
        $news = NasionalNews::where('kategori', 'Nasional')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.nasional', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = NasionalNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
