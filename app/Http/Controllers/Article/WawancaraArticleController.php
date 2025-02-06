<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\WawancaraArticle;
use Illuminate\Http\Request;

class WawancaraArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel Wawancara.
     */
    public function index()
    {
        // Ambil artikel dengan kategori 'Wawancara' dan visibilitas 'public'
        $articles = WawancaraArticle::where('kategori', 'Wawancara')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.wawancara', compact('articles'));
    }

    /**
     * Tampilkan detail artikel berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $articleId = $request->query('a');
        $article = WawancaraArticle::where('id', $articleId)->firstOrFail();

        return view('kategori.article-detail', compact('article'));
    }
}
