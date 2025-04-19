<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\LiputanKhususNews;
use Illuminate\Http\Request;

class LiputanKhususNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Liputan Khusus.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Liputan Khusus' dan visibilitas 'public'
        $news = LiputanKhususNews::where('kategori', 'Liputan Khusus')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.liputanKhusus', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = LiputanKhususNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
