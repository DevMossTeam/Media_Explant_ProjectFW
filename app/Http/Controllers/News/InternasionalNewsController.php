<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\InternasionalNews;
use Illuminate\Http\Request;

class InternasionalNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Internasional.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Internasional' dan visibilitas 'public'
        $news = InternasionalNews::where('kategori', 'Internasional')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.internasional', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = InternasionalNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
