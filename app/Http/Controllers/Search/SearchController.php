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
            ->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%")
                    ->orWhere('kategori', 'like', "%$keyword%");
            })
            ->orderByDesc('release_date')
            ->limit(5)
            ->pluck('judul')
            ->toArray();

        $judulBerita = DB::table('berita')
            ->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%")
                    ->orWhere('kategori', 'like', "%$keyword%");
            })
            ->orderByDesc('tanggal_diterbitkan')
            ->limit(5)
            ->pluck('judul')
            ->toArray();

        $judulKarya = DB::table('karya')
            ->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%")
                    ->orWhere('kategori', 'like', "%$keyword%");
            })
            ->orderByDesc('release_date')
            ->limit(5)
            ->pluck('judul')
            ->toArray();

        $namaTags = DB::table('tag')
            ->where('nama_tag', 'like', "%$keyword%")
            ->limit(5)
            ->pluck('nama_tag')
            ->toArray();

        $allResults = array_unique(array_merge($judulProduk, $judulBerita, $judulKarya, $namaTags));

        return response()->json($allResults);
    }

    public function index(Request $request)
    {
        $keyword = $request->get('query');

        // Produk
        $produk = DB::table('produk')
            ->select('id', 'judul', 'kategori', 'deskripsi', 'release_date')
            ->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%")
                    ->orWhere('kategori', 'like', "%$keyword%");
            })
            ->orderByDesc('release_date')
            ->paginate(20, ['*'], 'produk_page');

        foreach ($produk as $item) {
            $item->thumbnail = asset('assets/IC-pdf-P.png');
        }

        // Berita dari judul
        $beritaByJudul = DB::table('berita')
            ->select('id', 'judul', 'kategori', 'konten_berita', 'tanggal_diterbitkan')
            ->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%")
                    ->orWhere('kategori', 'like', "%$keyword%");
            });

        // Berita dari tag.nama_tag
        $beritaByTag = DB::table('tag')
            ->join('berita', 'tag.berita_id', '=', 'berita.id')
            ->where('tag.nama_tag', 'like', "%$keyword%")
            ->select('berita.id', 'berita.judul', 'berita.kategori', 'berita.konten_berita', 'berita.tanggal_diterbitkan');

        // Gabungkan & urutkan berita
        $mergedBerita = $beritaByJudul->union($beritaByTag)
            ->orderByDesc('tanggal_diterbitkan')
            ->paginate(100, ['*'], 'berita_page');

        foreach ($mergedBerita as $item) {
            $item->thumbnail = $this->extractFirstImage($item->konten_berita);
        }

        // Karya
        $karya = DB::table('karya')
            ->select('id', 'judul', 'kategori', 'media', 'deskripsi', 'release_date')
            ->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%")
                    ->orWhere('kategori', 'like', "%$keyword%");
            })
            ->orderByDesc('release_date')
            ->paginate(50, ['*'], 'karya_page');

        foreach ($karya as $item) {
            $item->thumbnail = (!empty($item->media) && strlen($item->media) > 50)
                ? 'data:image/jpeg;base64,' . $item->media
                : asset('images/default-thumbnail.jpg');
        }

        $total = $produk->total() + $mergedBerita->total() + $karya->total();

        return view('search.results', [
            'produk' => $produk,
            'berita' => $mergedBerita,
            'karya' => $karya,
            'keyword' => $keyword,
            'total' => $total,
        ]);
    }

    private function extractFirstImage($html)
    {
        if (empty($html)) return null;

        // Remove non-breaking space artifacts
        $cleanHtml = str_replace('&nbsp;', ' ', $html);

        preg_match('/<img[^>]+src=["\']?([^"\'>]+)["\']?/i', $cleanHtml, $matches);
        return $matches[1] ?? null;
    }
}
