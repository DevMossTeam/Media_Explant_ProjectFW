<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use App\Models\Karya\DesainGrafis;
use Illuminate\Http\Request;

class DesainGrafisController extends Controller
{
    // Menampilkan daftar karya desain grafis
    public function index()
    {
        $karya = DesainGrafis::with('user')
            ->where('kategori', 'desain_grafis')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->paginate(12);

        return view('karya.desain-grafis', compact('karya'));
    }

    // Menampilkan detail karya
    public function show($id)
    {
        $karya = DesainGrafis::with('user')
            ->where('id', $id)
            ->where('kategori', 'desain_grafis')
            ->where('visibilitas', 'public')
            ->firstOrFail();

        // Ambil 4 karya lain untuk rekomendasi (selain yang sedang dilihat)
        $rekomendasi = DesainGrafis::with('user')
            ->where('id', '!=', $id)
            ->where('kategori', 'desain_grafis')
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('karya.detail.desainGrafis-detail', compact('karya', 'rekomendasi'));
    }
}
