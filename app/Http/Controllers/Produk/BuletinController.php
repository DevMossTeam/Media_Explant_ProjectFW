<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk\Buletin;

class BuletinController extends Controller
{
    public function show($id)
    {
        // Cek ID yang diterima
        \Log::info("Mencari Buletin dengan ID: " . $id);

        // Ambil data dari database
        $buletin = Buletin::where('id', $id)
            ->where('kategori', 'Buletin')
            ->first();

        // Debugging untuk memastikan data ditemukan
        if (!$buletin) {
            \Log::error("Buletin tidak ditemukan untuk ID: " . $id);
            dd("Buletin tidak ditemukan. Cek ID:", $id);
        }

        return view('produk.buletin', compact('buletin'));
    }
}
