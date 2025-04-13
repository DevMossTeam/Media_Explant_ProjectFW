<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk\Majalah;
use Illuminate\Support\Facades\Response;

class MajalahController extends Controller
{
    // Menampilkan majalah
    public function index()
    {
        // 14 majalah terbaru untuk "Produk Kami"
        $majalahs = Majalah::where('kategori', 'Majalah')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(14)
            ->get();

        // 8 majalah terbaru untuk "Terbaru"
        $majalahsTerbaru = Majalah::where('kategori', 'Majalah')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(8)
            ->get();

        return view('produk.majalah', compact('majalahs', 'majalahsTerbaru'));
    }

    // Menampilkan halaman detail majalah
    public function show(Request $request)
    {
        $id = $request->query('f');

        // Ambil majalah utama
        $majalah = Majalah::with('user')
            ->where('visibilitas', 'public')
            ->where('id', $id)
            ->where('kategori', 'Majalah')
            ->first();

        if (!$majalah) {
            return abort(404, "Majalah tidak ditemukan.");
        }

        // Ambil rekomendasi Majalah lain dengan pagination
        $rekomendasiMajalah = Majalah::where('kategori', 'Majalah')
            ->where('visibilitas', 'public')
            ->where('id', '!=', $id)
            ->orderBy('release_date', 'desc')
            ->paginate(6);

        // Cek jika request adalah AJAX (untuk pagination)
        if ($request->ajax()) {
            return view('produk.partials.MajalahRekomendasi', compact('rekomendasiMajalah'))->render();
        }

        // Jika bukan AJAX, tampilkan full page
        return view('produk.majalah_detail', compact('majalah', 'rekomendasiMajalah'));
    }

    // Menampilkan halaman pertama PDF sebagai thumbnail
    public function pdfPreview($id)
    {
        $majalah = Majalah::findOrFail($id);

        if (!$majalah || !$majalah->media) {
            return abort(404, "PDF tidak ditemukan.");
        }

        return Response::make($majalah->media, 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function download($id)
    {
        $majalah = Majalah::findOrFail($id);

        if (!$majalah || !$majalah->media) {
            return abort(404, "PDF tidak ditemukan.");
        }

        $filename = str_replace(' ', '_', $majalah->judul) . '.pdf';

        return Response::make($majalah->media, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function preview(Request $request)
    {
        $id = $request->query('f');

        $majalah = Majalah::findOrFail($id);

        if (!$majalah || !$majalah->media) {
            return abort(404, "Majalah tidak ditemukan.");
        }

        return view('produk.majalah_preview', compact('majalah'));
    }
}
