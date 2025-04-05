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
            ->orderBy('release_date', 'desc')
            ->take(14)
            ->get();

        // 8 majalah terbaru untuk "Terbaru"
        $majalahsTerbaru = Majalah::where('kategori', 'Majalah')
            ->orderBy('release_date', 'desc')
            ->take(8)
            ->get();

        return view('produk.majalah', compact('majalahs', 'majalahsTerbaru'));
    }

    // Menampilkan halaman detail majalah
    public function show(Request $request)
    {
        $id = $request->query('f');

        $majalah = Majalah::with('user')
            ->where('id', $id)
            ->where('kategori', 'Majalah')
            ->first();

        if (!$majalah) {
            return abort(404, "Majalah tidak ditemukan.");
        }

        return view('produk.majalah_detail', compact('majalah'));
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
}
