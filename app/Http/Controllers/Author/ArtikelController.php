<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author\Artikel;
use App\Models\Author\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|max:200',
            'konten_artikel' => 'required|max:65535',
            'kategori' => 'required',
            'visibilitas' => 'required|in:public,private',
            'tags' => 'required',
        ]);

        // Ambil uid dari cookie
        $userUid = $request->cookie('user_uid');

        // Buat artikel
        $articleId = Str::random(12); // ID artikel dibuat secara acak
        $article = Artikel::create([
            'id' => $articleId,
            'judul' => $request->judul,
            'tanggal_diterbitkan' => $request->tanggal_diterbitkan,
            'user_id' => $userUid, // Simpan uid langsung ke kolom user_id
            'kategori' => $request->kategori,
            'konten_artikel' => $request->konten_artikel,
            'visibilitas' => $request->visibilitas,
        ]);

        // Simpan tags
        $tags = explode(',', $request->tags);
        foreach ($tags as $tag) {
            Tag::create([
                'id' => Str::random(12),
                'nama_tag' => trim($tag),
                'artikel_id' => $articleId,
            ]);
        }

        return redirect()->back()->with('success', 'Artikel berhasil dipublikasikan.');
    }
}
