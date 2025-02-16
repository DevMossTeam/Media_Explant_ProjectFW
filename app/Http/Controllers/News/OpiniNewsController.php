<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\OpiniNews;
use Illuminate\Http\Request;

class OpiniNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Opini.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Opini' dan visibilitas 'public'
        $news = OpiniNews::where('kategori', 'Opini')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.opini', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = OpiniNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
