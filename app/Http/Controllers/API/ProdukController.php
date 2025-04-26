<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\API\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    // 1. Endpoint ambil daftar produk (tanpa BLOB media)
    public function getProdukMajalah(Request $request)
    {
        $userId = $request->query('user_id') ?? null;

        // Mengambil data produk kategori majalah
        $produk = Produk::where('kategori', 'majalah')
            ->with(['user', 'bookmarks', 'reaksis', 'komentars'])
            ->orderBy('release_date', 'desc')
            ->limit(2)
            ->get();

        // Format dan kirimkan response
        return response()->json($this->formatProdukResponse($produk, $userId));
    }

    // Fungsi format data produk
    private function formatProdukResponse($produks, $userId)
    {
        return $produks->map(function ($produk) use ($userId) {
            $tanggalDiterbitkan = Carbon::parse($produk->release_date);

            return [
                'idproduk' => $produk->id,
                'penulis' => $produk->user_id,
                'judul' => $produk->judul,
                'deskripsi' => $produk->deskripsi,
                'release_date' => $tanggalDiterbitkan->toDateTimeString(),
                'profil' => $produk->user->profile_pic ?? null,
                'kategori' => $produk->kategori,
                // Hanya kirimkan link untuk ambil media
                'media_url' => url('/api/produk-majalah/'.$produk->id.'/media'),
                'jumlahLike' => $produk->reaksis->where('jenis_reaksi', 'Suka')->count(),
                'jumlahDislike' => $produk->reaksis->where('jenis_reaksi', 'Tidak Suka')->count(),
                'jumlahKomentar' => $produk->komentars->count(),
                'isBookmark' => $produk->bookmarks->where('user_id', $userId)->count() > 0,
                'isLike' => $produk->reaksis->where('user_id', $userId)->where('jenis_reaksi', 'Suka')->count() > 0,
                'isDislike' => $produk->reaksis->where('user_id', $userId)->where('jenis_reaksi', 'Tidak Suka')->count() > 0,
            ];
        })->toArray();
    }

    // 2. Endpoint khusus download media produk
    public function getProdukMedia($id)
    {
        $produk = Produk::findOrFail($id);

        if (!$produk->media) {
            return response()->json(['message' => 'Media tidak ditemukan'], 404);
        }

        return response($produk->media)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="produk-'.$produk->id.'.pdf"');
    }
}
