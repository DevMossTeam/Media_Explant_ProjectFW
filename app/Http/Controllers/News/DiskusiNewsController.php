<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\DiskusiNews;
use Illuminate\Http\Request;

class DiskusiNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Diskusi.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Diskusi' dan visibilitas 'public'
        $news = DiskusiNews::where('kategori', 'Diskusi')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.diskusi', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = DiskusiNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
