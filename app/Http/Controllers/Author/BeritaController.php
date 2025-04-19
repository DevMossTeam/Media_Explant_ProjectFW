<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author\Berita;
use App\Models\Author\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input (tags tidak wajib)
        $request->validate([
            'judul' => 'required|max:100',
            'konten_berita' => 'required|max:65535',
            'kategori' => 'required',
            'visibilitas' => 'required|in:public,private',
        ]);

        // Ambil uid dari cookie
        $userUid = $request->cookie('user_uid');

        // Buat berita
        $articleId = Str::random(12); // ID berita dibuat secara acak
        $article = Berita::create([
            'id' => $articleId,
            'judul' => $request->judul,
            'tanggal_diterbitkan' => $request->tanggal_diterbitkan,
            'user_id' => $userUid,
            'kategori' => $request->kategori,
            'konten_berita' => $request->konten_berita,
            'visibilitas' => $request->visibilitas,
        ]);

        // Simpan tags jika ada
        if ($request->has('tags') && !empty($request->tags)) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag) {
                Tag::create([
                    'id' => Str::random(12),
                    'nama_tag' => trim($tag),
                    'berita_id' => $articleId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Berita berhasil dipublikasikan.');
    }
}
