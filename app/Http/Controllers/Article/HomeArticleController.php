<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article\HomeArticle;
use Illuminate\Http\Request;

class HomeArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel di homepage
     */
    public function index(Request $request, $category = null)
    {
        // Jika tidak ada kategori, tampilkan homepage
        if (!$category) {
            $articles = HomeArticle::where('visibilitas', 'public')
                ->orderBy('tanggal_diterbitkan', 'desc')
                ->paginate(10);
            return view('home', compact('articles'));
        }

        // Daftar kategori yang valid
        $validCategories = ['siaran-pers', 'riset', 'wawancara', 'diskusi', 'agenda', 'sastra', 'opini'];

        // Jika kategori tidak ditemukan, tampilkan 404
        if (!in_array($category, $validCategories)) {
            abort(404);
        }

        // Ambil artikel berdasarkan kategori
        $articles = HomeArticle::where('kategori', str_replace('-', ' ', ucfirst($category)))
            ->where('visibilitas', 'public')
            ->orderBy('tanggal_diterbitkan', 'desc')
            ->paginate(10);

        return view('kategori.article-list', compact('articles', 'category'));
    }

    public function show($category, $slug)
    {
        $article = HomeArticle::where('slug', $slug)->firstOrFail();
        return view('article-detail', compact('article'));
    }
}
