<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\OpiniArticle;
use Illuminate\Http\Request;

class OpiniArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel Opini.
     */
    public function index()
    {
        // Ambil artikel dengan kategori 'Opini' dan visibilitas 'public'
        $articles = OpiniArticle::where('kategori', 'Opini')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.opini', compact('articles'));
    }

    /**
     * Tampilkan detail artikel berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $articleId = $request->query('a');
        $article = OpiniArticle::where('id', $articleId)->firstOrFail();

        return view('kategori.article-detail', compact('article'));
    }
}
