<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\AgendaArticle;
use Illuminate\Http\Request;

class AgendaArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel Agenda.
     */
    public function index()
    {
        // Ambil artikel dengan kategori 'Agenda' dan visibilitas 'public'
        $articles = AgendaArticle::where('kategori', 'Agenda')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.agenda', compact('articles'));
    }

    /**
     * Tampilkan detail artikel berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $articleId = $request->query('a');
        $article = AgendaArticle::where('id', $articleId)->firstOrFail();

        return view('kategori.article-detail', compact('article'));
    }
}
