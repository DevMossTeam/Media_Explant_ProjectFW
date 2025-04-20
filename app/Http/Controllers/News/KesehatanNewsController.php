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
        $terbaru = KesehatanNews::with('user')
            ->where('kategori', 'Kesehatan')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $terpopuler = KesehatanNews::with('user')
            ->where('kategori', 'Kesehatan')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $rekomendasi = KesehatanNews::with('user')
            ->where('kategori', 'Kesehatan')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.kesehatan', compact('terbaru', 'terpopuler', 'rekomendasi'));
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
