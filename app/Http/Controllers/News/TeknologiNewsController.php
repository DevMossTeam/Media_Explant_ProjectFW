<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\TeknologiNews;
use Illuminate\Http\Request;
use App\Models\UserReact\Reaksi;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Komentar;

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
            ->withCount([
                'reaksiSuka as like_count'
            ])
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $terpopuler = TeknologiNews::with('user')
            ->where('kategori', 'Teknologi')
            ->where('visibilitas', 'public')
            ->withCount([
                'reaksiSuka as like_count'
            ])
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $rekomendasi = TeknologiNews::with('user')
            ->where('kategori', 'Teknologi')
            ->where('visibilitas', 'public')
            ->withCount([
                'reaksiSuka as like_count'
            ])
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
        $news->increment('view_count');

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

        $relatedNews = TeknologiNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->where('visibilitas', 'public')
            ->orderByDesc('view_count')
            ->orderByDesc('tanggal_diterbitkan')
            ->take(6)
            ->get();

        $recommendedNews = TeknologiNews::where('kategori', $news->kategori)
            ->where('id', '!=', $news->id)
            ->where('visibilitas', 'public')
            ->withCount([
                'reaksiSuka as suka_count'
            ])
            ->orderByDesc('suka_count')
            ->orderByDesc('view_count')
            ->orderByDesc('tanggal_diterbitkan')
            ->take(6)
            ->get();

        $randomKategori = TeknologiNews::where('kategori', '!=', $news->kategori)
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->value('kategori');

        $otherTopics = TeknologiNews::where('kategori', $randomKategori)
            ->where('visibilitas', 'public')
            ->withCount([
                'reaksiSuka as suka_count'
            ])
            ->orderByDesc('view_count')
            ->orderByDesc('suka_count')
            ->orderByDesc('tanggal_diterbitkan')
            ->take(8)
            ->get();

        return view('kategori.news-detail', compact('news', 'relatedNews', 'recommendedNews', 'otherTopics', 'likeCount', 'dislikeCount', 'userReaksi', 'komentarList'));
    }
}
