<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk\Buletin;
use Illuminate\Support\Facades\Storage;
use Imagick;

class BuletinController extends Controller
{
    public function index()
    {
        // Ambil 3 produk terbaru dengan kategori "Buletin"
        $buletins = Buletin::where('kategori', 'Buletin')
                            ->orderBy('release_date', 'desc')
                            ->take(3)
                            ->get();

        // Ambil 12 produk terbaru dengan kategori "Buletin"
        $latestBuletins = Buletin::where('kategori', 'Buletin')
                                ->orderBy('release_date', 'desc')
                                ->take(12)
                                ->get();

        return view('produk.buletin', compact('buletins', 'latestBuletins'));
    }
}
