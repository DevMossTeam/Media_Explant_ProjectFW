<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk\Buletin;
use Illuminate\Support\Facades\Storage;

class BuletinController extends Controller
{
    // Menampilkan 3 buletin terbaru
    public function index()
    {
        $buletins = Buletin::where('kategori', 'Buletin')
                            ->orderBy('release_date', 'desc')
                            ->take(3)
                            ->get();

        return view('produk.buletin', compact('buletins'));
    }

    // Menampilkan halaman detail buletin
    public function show($id)
    {
        $buletin = Buletin::where('id', $id)->where('kategori', 'Buletin')->first();

        if (!$buletin) {
            return abort(404, "Buletin dengan ID $id tidak ditemukan.");
        }

        return view('produk.buletin_detail', compact('buletin'));
    }

    // Menampilkan halaman pertama PDF sebagai thumbnail
    public function pdfPreview($id)
    {
        $buletin = Buletin::findOrFail($id);
        $pdfData = $buletin->media; // Sesuai dengan kolom di database

        return response($pdfData)->header('Content-Type', 'application/pdf');
    }
}
