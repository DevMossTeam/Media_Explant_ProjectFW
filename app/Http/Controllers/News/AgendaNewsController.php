<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\AgendaNews;
use Illuminate\Http\Request;

class AgendaNewsController extends Controller
{
    /**
     * Tampilkan daftar berita Agenda.
     */
    public function index()
    {
        // Ambil berita dengan kategori 'Agenda' dan visibilitas 'public'
        $news = AgendaNews::where('kategori', 'Agenda')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.agenda', compact('news'));
    }

    /**
     * Tampilkan detail berita berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $newsId = $request->query('a');
        $news = AgendaNews::where('id', $newsId)->firstOrFail();

        return view('kategori.news-detail', compact('news'));
    }
}
