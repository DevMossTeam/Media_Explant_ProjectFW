<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk\Buletin;
use Illuminate\Support\Facades\Response;

class BuletinController extends Controller
{
    // Menampilkan buletin
    public function index()
    {
        // 3 buletin terbaru untuk "Produk Kami"
        $buletins = Buletin::where('kategori', 'Buletin')
            ->orderBy('release_date', 'desc')
            ->take(3)
            ->get();

        // 9 buletin terbaru untuk "Terbaru"
        $buletinsTerbaru = Buletin::where('kategori', 'Buletin')
            ->orderBy('release_date', 'desc')
            ->take(9)
            ->get();

            $buletinsRekomendasi = Buletin::where('kategori', 'Buletin')
            ->orderBy('release_date', 'desc')
            ->take(12)
            ->get();

        return view('produk.buletin', compact('buletins', 'buletinsTerbaru', 'buletinsRekomendasi'));
    }

    // Menampilkan halaman detail buletin
    public function show(Request $request)
    {
        $id = $request->query('f');

        $buletin = Buletin::findOrFail($id);

        $buletin = Buletin::with('user')
            ->where('id', $id)
            ->where('kategori', 'Buletin')
            ->first();

        if (!$buletin) {
            return abort(404, "Buletin tidak ditemukan.");
        }

        // Rekomendasi Buletin (dengan paginasi)
        $rekomendasiBuletin = Buletin::where('kategori', 'Buletin')
            ->where('id', '!=', $id)
            ->orderBy('release_date', 'desc')
            ->paginate(6); // atau jumlah sesuai kebutuhan

        return view('produk.buletin_detail', compact('buletin', 'rekomendasiBuletin'));
    }

    // Menampilkan halaman pertama PDF sebagai thumbnail
    public function pdfPreview($id)
    {
        $buletin = Buletin::findOrFail($id);

        if (!$buletin || !$buletin->media) {
            return abort(404, "PDF tidak ditemukan.");
        }

        return Response::make($buletin->media, 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function download($id)
    {
        $buletin = Buletin::findOrFail($id);

        if (!$buletin || !$buletin->media) {
            return abort(404, "PDF tidak ditemukan.");
        }

        $filename = str_replace(' ', '_', $buletin->judul) . '.pdf';

        return Response::make($buletin->media, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function preview(Request $request)
    {
        $id = $request->query('f');

        $buletin = Buletin::findOrFail($id);

        if (!$buletin || !$buletin->media) {
            return abort(404, "Buletin tidak ditemukan.");
        }

        return view('produk.buletin_preview', compact('buletin'));
    }

}
