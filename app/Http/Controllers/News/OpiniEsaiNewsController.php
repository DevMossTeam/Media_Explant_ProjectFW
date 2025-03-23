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
        // Ambil berita dengan kategori 'Opini dan Esai' dan visibilitas 'public'
        $news = OpiniEsaiNews::where('kategori', 'Opini dan Esai')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.opini-esai', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = OpiniEsaiNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
