<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function preview(Request $request)
    {
        $keyword = $request->get('query');

        $judulProduk = DB::table('produk')
            ->where('judul', 'like', "%$keyword%")
            ->orderByDesc('release_date')
            ->limit(5)
            ->pluck('judul')
            ->toArray();

        $judulBerita = DB::table('berita')
            ->where('judul', 'like', "%$keyword%")
            ->orderByDesc('tanggal_diterbitkan')
            ->limit(5)
            ->pluck('judul')
            ->toArray();

        $judulKarya = DB::table('karya')
            ->where('judul', 'like', "%$keyword%")
            ->orderByDesc('release_date')
            ->limit(5)
            ->pluck('judul')
            ->toArray();

        $namaTags = DB::table('tag')
            ->where('nama_tag', 'like', "%$keyword%")
            ->limit(5)
            ->pluck('nama_tag')
            ->toArray();

        // Gabungkan semua hasil dan hilangkan duplikat
        $allResults = array_unique(array_merge($judulProduk, $judulBerita, $judulKarya, $namaTags));

        return response()->json($allResults);
    }

    public function index(Request $request)
    {
        $keyword = $request->get('query');

        // Produk
        $produk = DB::table('produk')
            ->where('judul', 'like', "%$keyword%")
            ->orderByDesc('release_date')
            ->get();

        // Berita dari judul langsung
        $beritaByJudul = DB::table('berita')
            ->where('judul', 'like', "%$keyword%")
            ->orderByDesc('tanggal_diterbitkan')
            ->get();

        // Berita dari tag.nama_tag
        $beritaByTag = DB::table('tag')
            ->join('berita', 'tag.berita_id', '=', 'berita.id')
            ->where('tag.nama_tag', 'like', "%$keyword%")
            ->select('berita.*')
            ->orderByDesc('berita.tanggal_diterbitkan')
            ->get();

        // Gabungkan berita dan hilangkan duplikat berdasarkan ID
        $mergedBerita = $beritaByJudul->merge($beritaByTag)->unique('id')->values();

        // Karya
        $karya = DB::table('karya')
            ->where('judul', 'like', "%$keyword%")
            ->orderByDesc('release_date')
            ->get();

        // Total semua
        $total = $produk->count() + $mergedBerita->count() + $karya->count();

        return view('search.results', [
            'produk' => $produk,
            'berita' => $mergedBerita,
            'karya' => $karya,
            'keyword' => $keyword,
            'total' => $total,
        ]);
    }
}
