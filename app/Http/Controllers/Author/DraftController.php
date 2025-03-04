<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\News\HomeNews;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    public function index()
    {
        $drafts = HomeNews::select('id', 'judul', 'konten_berita', 'tanggal_diterbitkan', 'visibilitas')
            ->whereIn('visibilitas', ['draft', 'pending'])
            ->orderBy('tanggal_diterbitkan', 'desc')
            ->paginate(10);

        // Debugging: Cek isi $drafts sebelum return
        dd($drafts);

        return view('authors.draft', compact('drafts'));
    }
}
