<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use App\Models\Karya\Syair;

class SyairController extends Controller
{
    public function index()
    {
        $terbaru = Syair::where('kategori', 'syair')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(6)
            ->get();

        $karya = Syair::with('user')
            ->where('kategori', 'syair')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(20)
            ->get();

        return view('karya.syair', compact('terbaru', 'karya'));
    }

    public function show()
    {
        $id = request()->get('k');

        $karya = Syair::with('user')
            ->where('id', $id)
            ->where('kategori', 'syair')
            ->where('visibilitas', 'public')
            ->firstOrFail();

        $rekomendasi = Syair::with('user')
            ->where('id', '!=', $id)
            ->where('kategori', 'syair')
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('karya.detail.syair-detail', compact('karya', 'rekomendasi'));
    }
}
