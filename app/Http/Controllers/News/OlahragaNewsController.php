<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\OlahragaNews;
use Illuminate\Http\Request;

class OlahragaNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Olahraga
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Olahraga' dan visibilitas 'public'
        $news = OlahragaNews::where('kategori', 'Olahraga')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.olahraga', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = OlahragaNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
