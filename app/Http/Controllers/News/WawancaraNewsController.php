<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\WawancaraNews;
use Illuminate\Http\Request;

class WawancaraNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Wawancara.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Wawancara' dan visibilitas 'public'
        $news = WawancaraNews::where('kategori', 'Wawancara')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.wawancara', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = WawancaraNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
