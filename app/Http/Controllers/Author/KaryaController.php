<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Karya;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        // Upload File
        $filePath = null;
        if ($request->hasFile('media')) {
            $filePath = $request->file('media')->store('karya_media', 'public');
        }

        // Simpan ke Database
        Karya::create([
            'id' => Str::random(12), // ID acak unik
            'creator' => $request->penulis,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi ?? '', // Default kosong jika tidak diisi
            'kategori' => $request->kategori,
            'media' => $filePath, // Simpan path, bukan HTML <img>
            'release_date' => now(), // Otomatis menggunakan waktu sekarang
            'visibilitas' => $request->visibilitas,
        ]);

        return redirect()->back()->with('success', 'Karya berhasil dipublikasikan!');
    }
}
