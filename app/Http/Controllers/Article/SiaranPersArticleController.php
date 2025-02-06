<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\SiaranPersArticle;
use Illuminate\Http\Request;

class SiaranPersArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel SiaranPers.
     */
    public function index()
    {
        // Ambil artikel dengan kategori 'SiaranPers' dan visibilitas 'public'
        $articles = SiaranPersArticle::where('kategori', 'Siaran Pers')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.siaranPers', compact('articles'));
    }

    /**
     * Tampilkan detail artikel berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $articleId = $request->query('a');
        $article = SiaranPersArticle::where('id', $articleId)->firstOrFail();

        return view('kategori.article-detail', compact('article'));
    }
}
