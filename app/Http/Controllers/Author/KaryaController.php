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
            'penulis' => 'required', // Nama Penulis wajib
            'judul' => 'required',
            'deskripsi' => 'required_unless:kategori,fotografi,desain_grafis', // Wajib kecuali kategori Fotografi & Desain Grafis
            'media' => 'required|file|mimes:jpg,jpeg,png|max:10240', // Pastikan hanya gambar dengan ukuran max 10MB
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
            'id' => Str::random(12), // ID acak unik
            'creator' => $request->penulis,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi ?? '', // Default kosong jika tidak diisi
            'kategori' => $request->kategori,
            'user_id' => $userUid,
            'media' => $fileBase64, // Simpan dalam bentuk base64 di kolom mediumtext
            'release_date' => now(), // Otomatis menggunakan waktu sekarang
            'visibilitas' => $request->visibilitas,
        ]);

        return redirect()->back()->with('success', 'Karya berhasil dipublikasikan!');
    }
}
