<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\RisetArticle;
use Illuminate\Http\Request;

class RisetArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel Riset.
     */
    public function index()
    {
        // Ambil artikel dengan kategori 'Riset' dan visibilitas 'public'
        $articles = RisetArticle::where('kategori', 'Riset')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.riset', compact('articles'));
    }

    /**
     * Tampilkan detail artikel berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $articleId = $request->query('a');
        $article = RisetArticle::where('id', $articleId)->firstOrFail();

        return view('kategori.article-detail', compact('article'));
    }
}
