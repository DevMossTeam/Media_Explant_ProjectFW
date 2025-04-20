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
        $terbaru = OlahragaNews::with('user')
            ->where('kategori', 'Olahraga')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $terpopuler = OlahragaNews::with('user')
            ->where('kategori', 'Olahraga')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $rekomendasi = OlahragaNews::with('user')
            ->where('kategori', 'Olahraga')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.olahraga', compact('terbaru', 'terpopuler', 'rekomendasi'));
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
