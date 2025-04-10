<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use App\Models\Karya\Puisi;

class PuisiController extends Controller
{
    public function index()
    {
        // Ambil 6 data terbaru
        $terbaru = Puisi::with('user')
            ->where('kategori', 'puisi')
            ->orderBy('release_date', 'desc')
            ->limit(6)
            ->get();

        // Ambil 20 data untuk "Karya Kami"
        $karya = Puisi::with('user')
            ->where('kategori', 'puisi')
            ->orderBy('release_date', 'desc')
            ->limit(20)
            ->get();

        return view('karya.puisi', compact('terbaru', 'karya'));
    }
}
