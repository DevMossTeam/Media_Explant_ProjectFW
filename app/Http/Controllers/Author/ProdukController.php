<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Produk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukController extends Controller
{
    public function create()
    {
        return view('author.create-product');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'kategori' => 'required|in:Buletin,Majalah',
            'media' => 'required|file|mimes:pdf,doc,docx|max:1048576',
            'visibilitas' => 'required|in:public,private',
        ]);

        // Ambil file dan ubah ke binary
        $file = $request->file('media');
        $fileContent = file_get_contents($file->getRealPath());

        // Simpan ke database menggunakan DB::table untuk debugging lebih mudah
        try {
            DB::table('produk')->insert([
                'id' => Str::random(12), // Buat ID unik
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'media' => $fileContent, // Simpan sebagai binary
                'release_date' => now()->toDateString(), // Set tanggal otomatis
                'visibilitas' => $request->visibilitas,
            ]);

            return redirect()->back()->with('success', 'Produk berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }
}
