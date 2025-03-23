<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\KampusNews;
use Illuminate\Http\Request;

class KampusNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Kampus.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Kampus' dan visibilitas 'public'
        $news = KampusNews::where('kategori', 'Kampus')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.kampus', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = KampusNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
