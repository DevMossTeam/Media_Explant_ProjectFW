<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\OpiniArticle;
use Illuminate\Http\Request;

class OpiniArticleController extends Controller
{
    public function index()
    {
        $articles = OpiniArticle::where('kategori', 'Opini')
            ->where('visibilitas', 'public')
            ->orderBy('tanggal_diterbitkan', 'desc')
            ->paginate(10);

        return view('kategori.opini', compact('articles'));
    }

    public function show($id)
    {
        $article = OpiniArticle::findOrFail($id);
        return view('artikel.detail', compact('article'));
    }
}
