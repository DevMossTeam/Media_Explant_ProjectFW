<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\OpiniEsaiNews;
use Illuminate\Http\Request;

class OpiniEsaiNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Opini dan Esai.
     */
    public function index()
    {
        $terbaru = OpiniEsaiNews::with('user')
            ->whereIn('kategori', ['Opini', 'Esai'])
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $rekomendasi = OpiniEsaiNews::with('user')
            ->whereIn('kategori', ['Opini', 'Esai'])
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        $terpopuler_opini = OpiniEsaiNews::with('user')
            ->where('kategori', 'Opini')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(5)
            ->get();

        $terpopuler_esai = OpiniEsaiNews::with('user')
            ->where('kategori', 'Esai')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(5)
            ->get();

        return view('kategori.opini-esai', compact(
            'terbaru',
            'rekomendasi',
            'terpopuler_opini',
            'terpopuler_esai'
        ));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        $newsId = $request->query('a');
        $news = OpiniEsaiNews::where('id', $newsId)->firstOrFail();

        // Berita terkait berdasarkan kategori yang sama
        $relatedNews = OpiniEsaiNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->latest('tanggal_diterbitkan')
            ->take(4)
            ->get();

        // Berita rekomendasi (bisa gunakan kriteria lain)
        $recommendedNews = OpiniEsaiNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Topik lainnya (berita dari kategori berbeda)
        $otherTopics = OpiniEsaiNews::where('kategori', '!=', $news->kategori)
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics'));
    }
}
