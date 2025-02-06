<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\DiskusiArticle;
use Illuminate\Http\Request;

class DiskusiArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel Diskusi.
     */
    public function index()
    {
        // Ambil artikel dengan kategori 'Diskusi' dan visibilitas 'public'
        $articles = DiskusiArticle::where('kategori', 'Diskusi')
            ->where('visibilitas', 'public')
            ->latest('tanggal_diterbitkan')
            ->paginate(10);

        return view('kategori.diskusi', compact('articles'));
    }

    /**
     * Tampilkan detail artikel berdasarkan query parameter.
     */
    public function show(Request $request)
    {
        // Ambil ID dari query string ?a=id
        $articleId = $request->query('a');
        $article = DiskusiArticle::where('id', $articleId)->firstOrFail();

        return view('kategori.article-detail', compact('article'));
    }
}
