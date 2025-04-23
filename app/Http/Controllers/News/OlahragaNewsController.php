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
        $newsId = $request->query('a');
        $news = OlahragaNews::where('id', $newsId)->firstOrFail();

        // Berita terkait berdasarkan kategori yang sama
        $relatedNews = OlahragaNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->latest('tanggal_diterbitkan')
            ->take(6)
            ->get();

        // Berita rekomendasi (bisa gunakan kriteria lain)
        $recommendedNews = OlahragaNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        // Topik lainnya (berita dari kategori berbeda)
        $otherTopics = OlahragaNews::where('kategori', '!=', $news->kategori)
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics'));
    }
}
