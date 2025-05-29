<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Karya;
use Illuminate\Support\Str;

class KaryaController extends Controller
{
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'penulis' => 'required', 
            'judul' => 'required',
            'deskripsi' => 'required_unless:kategori,fotografi,desain_grafis',
            'konten' => 'nullable',
            'media' => 'required|file|mimes:jpg,jpeg,png|max:10240',
            'visibilitas' => 'required|in:public,private'
        ]);

        // Konversi file gambar menjadi base64
        $fileBase64 = null;
        if ($request->hasFile('media')) {
            $fileBase64 = base64_encode(file_get_contents($request->file('media')->path()));
        }

        // Ambil uid dari cookie
        $userUid = $request->cookie('user_uid');

        // Simpan ke Database
        Karya::create([
            'id' => Str::random(12),
            'creator' => $request->penulis,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi ?? '',
            'konten' => $request->konten ?? '',
            'kategori' => $request->kategori,
            'user_id' => $userUid,
            'media' => $fileBase64,
            'release_date' => now(),
            'visibilitas' => $request->visibilitas,
        ]);

        return redirect()->back()->with('success', 'Karya berhasil dipublikasikan!');
    }
}
