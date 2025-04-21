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
        $terbaru = KesenianHiburanNews::with('user')
            ->whereIn('kategori', ['Kesenian', 'Hiburan'])
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(10)
            ->get();

        $rekomendasi = KesenianHiburanNews::with('user')
            ->whereIn('kategori', ['Kesenian', 'Hiburan'])
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(8)
            ->get();

        $terpopuler_kesenian = KesenianHiburanNews::with('user')
            ->where('kategori', 'Kesenian')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(5)
            ->get();

        $terpopuler_hiburan = KesenianHiburanNews::with('user')
            ->where('kategori', 'Hiburan')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->take(5)
            ->get();

        return view('kategori.kesenianHiburan', compact(
            'terbaru',
            'rekomendasi',
            'terpopuler_kesenian',
            'terpopuler_hiburan'
        ));
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
