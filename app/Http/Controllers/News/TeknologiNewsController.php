<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\TeknologiNews;
use Illuminate\Http\Request;

class TeknologiNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Teknologi.
     */
    public function index()
    {
        $terbaru = TeknologiNews::with('user')
            ->where('kategori', 'Teknologi')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $terpopuler = TeknologiNews::with('user')
            ->where('kategori', 'Teknologi')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $rekomendasi = TeknologiNews::with('user')
            ->where('kategori', 'Teknologi')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.teknologi', compact('terbaru', 'terpopuler', 'rekomendasi'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        $newsId = $request->query('a');
        $news = TeknologiNews::where('id', $newsId)->firstOrFail();

        // Berita terkait berdasarkan kategori yang sama
        $relatedNews = TeknologiNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->latest('tanggal_diterbitkan')
            ->take(6)
            ->get();

        // Berita rekomendasi (bisa gunakan kriteria lain)
        $recommendedNews = TeknologiNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        // Topik lainnya (berita dari kategori berbeda)
        $otherTopics = TeknologiNews::where('kategori', '!=', $news->kategori)
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics'));
    }
}
