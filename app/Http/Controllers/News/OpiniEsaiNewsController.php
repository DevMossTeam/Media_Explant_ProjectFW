<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\OpiniEsaiNews;
use Illuminate\Http\Request;
use App\Models\UserReact\Reaksi;
use Illuminate\Support\Facades\Auth;

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

        $likeCount = Reaksi::where('item_id', $news->id)
            ->where('jenis_reaksi', 'Suka')
            ->count();

        $dislikeCount = Reaksi::where('item_id', $news->id)
            ->where('jenis_reaksi', 'Tidak Suka')
            ->count();

        $userReaksi = null;
        if (Auth::check()) {
            $userReaksi = Reaksi::where('user_id', Auth::user()->uid)
                ->where('item_id', $news->id)
                ->where('reaksi_type', 'Berita')
                ->first();
        }

        // Berita terkait berdasarkan kategori yang sama
        $relatedNews = OpiniEsaiNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->latest('tanggal_diterbitkan')
            ->take(6)
            ->get();

        // Berita rekomendasi (bisa gunakan kriteria lain)
        $recommendedNews = OpiniEsaiNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        // Topik lainnya (berita dari kategori berbeda)
        $otherTopics = OpiniEsaiNews::where('kategori', '!=', $news->kategori)
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics', 'likeCount', 'dislikeCount', 'userReaksi'));
    }
}
