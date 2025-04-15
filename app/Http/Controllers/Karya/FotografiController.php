<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karya\Fotografi;

class FotografiController extends Controller
{
    public function index()
    {
        // 14 karya utama
        $karya = Fotografi::with('user')
            ->where('kategori', 'fotografi')
            ->where('visibilitas', 'public')
            ->latest('release_date')
            ->take(16)
            ->get();

        // 4 terbaru
        $terbaru = Fotografi::where('kategori', 'fotografi')
            ->where('visibilitas', 'public')
            ->latest('release_date')
            ->take(4)
            ->get();

        // 6 rekomendasi hari ini
        $rekomendasi = Fotografi::where('kategori', 'fotografi')
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('karya.fotografi', compact('karya', 'terbaru', 'rekomendasi'));
    }

    public function show()
    {
        $id = request()->get('k');

        $karya = Fotografi::with('user')
            ->where('id', $id)
            ->where('kategori', 'fotografi')
            ->where('visibilitas', 'public')
            ->firstOrFail();

        $rekomendasi = Fotografi::with('user')
            ->where('id', '!=', $id)
            ->where('kategori', 'fotografi')
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('karya.detail.fotografi-detail', compact('karya', 'rekomendasi'));
    }
}
