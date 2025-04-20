<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\LiputanKhususNews;
use Illuminate\Http\Request;

class LiputanKhususNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Liputan Khusus.
     */
    public function index()
    {
        $terbaru = LiputanKhususNews::with('user')
            ->where('kategori', 'Liputan Khusus')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $terpopuler = LiputanKhususNews::with('user')
            ->where('kategori', 'Liputan Khusus')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $rekomendasi = LiputanKhususNews::with('user')
            ->where('kategori', 'Liputan Khusus')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.liputanKhusus', compact('terbaru', 'terpopuler', 'rekomendasi'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = LiputanKhususNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
