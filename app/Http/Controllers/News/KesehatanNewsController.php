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
        $newsId = $request->query('a');
        $news = KesehatanNews::where('id', $newsId)->firstOrFail();

        // Berita terkait berdasarkan kategori yang sama
        $relatedNews = KesehatanNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->latest('tanggal_diterbitkan')
            ->take(4)
            ->get();

        // Berita rekomendasi (bisa gunakan kriteria lain)
        $recommendedNews = KesehatanNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Topik lainnya (berita dari kategori berbeda)
        $otherTopics = KesehatanNews::where('kategori', '!=', $news->kategori)
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics'));
    }
}
