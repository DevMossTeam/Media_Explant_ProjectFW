<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk\Buletin;

class BuletinController extends Controller
{
    public function show($id)
    {
        // Mengambil data buletin berdasarkan ID dan kategori 'Buletin'
        $buletin = Buletin::whereRaw('BINARY id = ?', [$id])
                            ->where('kategori', 'Buletin')
                            ->first();

        if (!$buletin) {
            return view('produk.buletin', ['error' => "Buletin dengan ID $id tidak ditemukan di database."]);
        }

        return view('produk.buletin', compact('buletin'));
    }
}
