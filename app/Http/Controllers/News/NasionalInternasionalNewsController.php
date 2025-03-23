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
        // Ambil berita dengan kategori 'Nasional dan Internasional' dan visibilitas 'public'
        $news = NasionalInternasionalNews::where('kategori', 'Nasional dan Internasional')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.nasional-internasional', compact('news'));
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
