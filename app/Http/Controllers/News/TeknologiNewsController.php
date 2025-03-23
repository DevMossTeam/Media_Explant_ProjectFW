<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\TeknologiNews;
use Illuminate\Http\Request;

class TeknologiNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Teknologi.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Teknologi' dan visibilitas 'public'
        $news = TeknologiNews::where('kategori', 'Teknologi')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.teknologi', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = TeknologiNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
