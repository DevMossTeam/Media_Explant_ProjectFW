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
        $terbaru = KampusNews::with('user')
            ->where('kategori', 'Kampus')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $terpopuler = KampusNews::with('user')
            ->where('kategori', 'Kampus')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $rekomendasi = KampusNews::with('user')
            ->where('kategori', 'Kampus')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.kampus', compact('terbaru', 'terpopuler', 'rekomendasi'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        $newsId = $request->query('a');
        $news = KampusNews::where('id', $newsId)->firstOrFail();

        // Berita terkait berdasarkan kategori yang sama
        $relatedNews = KampusNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->latest('tanggal_diterbitkan')
            ->take(6)
            ->get();

        // Berita rekomendasi (bisa gunakan kriteria lain)
        $recommendedNews = KampusNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        // Topik lainnya (berita dari kategori berbeda)
        $otherTopics = KampusNews::where('kategori', '!=', $news->kategori)
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics'));
    }
}
