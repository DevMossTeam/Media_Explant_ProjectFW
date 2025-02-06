<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\SastraArticle;
use Illuminate\Http\Request;

class SastraArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel Sastra.
     */
    public function index()
    {
        // Ambil artikel dengan kategori 'Sastra' dan visibilitas 'public'
        $articles = SastraArticle::where('kategori', 'Sastra')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.sastra', compact('articles'));
    }

    /**
     * Tampilkan detail artikel berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $articleId = $request->query('a');
        $article = SastraArticle::where('id', $articleId)->firstOrFail();

        return view('kategori.article-detail', compact('article'));
    }
}
