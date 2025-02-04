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
            ->latest('tanggal_diterbitkan') // Alternatif dari orderBy('tanggal_diterbitkan', 'desc')
            ->paginate(10);

        return view('kategori.opini', compact('articles'));
    }

    /**
     * Tampilkan detail artikel berdasarkan model binding.
     */
    public function show(OpiniArticle $article)
    {
        return view('kategori.article-detail', compact('article'));
    }
}
