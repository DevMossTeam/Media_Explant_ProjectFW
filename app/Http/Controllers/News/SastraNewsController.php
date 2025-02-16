<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\SastraNews;
use Illuminate\Http\Request;

class SastraNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Sastra.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Sastra' dan visibilitas 'public'
        $news = SastraNews::where('kategori', 'Sastra')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.sastra', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = SastraNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
