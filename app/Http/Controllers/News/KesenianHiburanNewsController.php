<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\KesenianHiburanNews;
use Illuminate\Http\Request;

class KesenianHiburanNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Kesenian dan Hiburan.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Kesenian dan Hiburan' dan visibilitas 'public'
        $news = KesenianHiburanNews::where('kategori', 'Kesenian', 'Hiburan')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.kesenianHiburan', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = KesenianHiburanNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
