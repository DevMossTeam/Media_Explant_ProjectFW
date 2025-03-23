<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\KesehatanAtletikNews;
use Illuminate\Http\Request;

class KesehatanAtletikNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Kesehatan dan Atletik.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Kesehatan dan Atletik' dan visibilitas 'public'
        $news = KesehatanAtletikNews::where('kategori', 'Kesehatan dan Atletik')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.kesehatan-atletik', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = KesehatanAtletikNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
