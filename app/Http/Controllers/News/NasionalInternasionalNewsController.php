<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\NasionalInternasionalNews;
use Illuminate\Http\Request;
use App\Models\UserReact\Reaksi;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Komentar;

class NasionalInternasionalNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Nasional dan Internasional.
     */
    public function index()
    {
        $terbaru = NasionalInternasionalNews::with('user')
            ->whereIn('kategori', ['Nasional', 'Internasional'])
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $rekomendasi = NasionalInternasionalNews::with('user')
            ->whereIn('kategori', ['Nasional', 'Internasional'])
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        $terpopuler_nasional = NasionalInternasionalNews::with('user')
            ->where('kategori', 'Nasional')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(5)
            ->get();

        $terpopuler_internasional = NasionalInternasionalNews::with('user')
            ->where('kategori', 'Internasional')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(5)
            ->get();

        return view('kategori.nasional-internasional', compact(
            'terbaru',
            'rekomendasi',
            'terpopuler_nasional',
            'terpopuler_internasional'
        ));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        $newsId = $request->query('a');
        $news = NasionalInternasionalNews::where('id', $newsId)->firstOrFail();

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

        $komentarList = Komentar::with(['user', 'replies.user'])
            ->where('komentar_type', 'Berita')
            ->where('item_id', $news->id)
            ->whereNull('parent_id') // hanya komentar utama
            ->orderBy('tanggal_komentar', 'desc')
            ->get();

        // Berita terkait berdasarkan kategori yang sama
        $relatedNews = NasionalInternasionalNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->latest('tanggal_diterbitkan')
            ->take(6)
            ->get();

        // Berita rekomendasi (bisa gunakan kriteria lain)
        $recommendedNews = NasionalInternasionalNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        // Topik lainnya (berita dari kategori berbeda)
        $otherTopics = NasionalInternasionalNews::where('kategori', '!=', $news->kategori)
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics', 'likeCount', 'dislikeCount', 'userReaksi', 'komentarList'));
    }
}
