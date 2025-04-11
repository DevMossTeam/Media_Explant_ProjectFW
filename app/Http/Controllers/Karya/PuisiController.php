<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use App\Models\Karya\Puisi;

class PuisiController extends Controller
{
    public function index()
    {
        $terbaru = Puisi::where('kategori', 'puisi')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(6)
            ->get();

        $karya = Puisi::with('user')
            ->where('kategori', 'puisi')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(20)
            ->get();

        return view('karya.puisi', compact('terbaru', 'karya'));
    }
}
