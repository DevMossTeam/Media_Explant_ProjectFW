<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\SiaranPersNews;
use Illuminate\Http\Request;

class SiaranPersNewsController extends Controller
{
    /**
     * Tampilkan daftar berita SiaranPers.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'SiaranPers' dan visibilitas 'public'
        $news = SiaranPersNews::where('kategori', 'Siaran Pers')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.siaranPers', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = SiaranPersNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
