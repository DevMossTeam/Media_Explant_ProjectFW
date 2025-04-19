<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\KesehatanNews;
use Illuminate\Http\Request;

class KesehatanNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Kesehatan.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Kesehatan' dan visibilitas 'public'
        $news = KesehatanNews::where('kategori', 'Kesehatan')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.kesehatan', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = KesehatanNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
