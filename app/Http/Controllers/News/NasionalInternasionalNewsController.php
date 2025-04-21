<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\NasionalInternasionalNews;
use Illuminate\Http\Request;

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
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = NasionalInternasionalNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
