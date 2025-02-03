<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\HomeArticle;
use Illuminate\Http\Request;

class HomeArticleController extends Controller
{
    public function index()
    {
        // Mengambil semua artikel tanpa filter kategori, urutkan berdasarkan tanggal terbaru
        $articles = HomeArticle::orderBy('tanggal_diterbitkan', 'desc')->paginate(10);

        return view('home', compact('articles'));
    }
}
