<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\KesenianSejarahNews;
use Illuminate\Http\Request;

class KesenianSejarahNewsController extends Controller
{
    /**
     * Tampilkan daftar berita KesenianSejarah.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'KesenianSejarah' dan visibilitas 'public'
        $news = KesenianSejarahNews::where('kategori', 'Kesenian dan Sejarah')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.kesenianSejarah', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = KesenianSejarahNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
