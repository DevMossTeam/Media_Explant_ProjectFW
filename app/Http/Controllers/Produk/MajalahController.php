<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk\Majalah;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Reaksi;
use App\Models\UserReact\Komentar;

class MajalahController extends Controller
{
    // Menampilkan daftar majalah
    public function index()
    {
        // Ambil hanya field penting tanpa 'media'
        $majalahs = Majalah::select('id', 'judul', 'kategori', 'deskripsi', 'release_date', 'user_id')
            ->where('kategori', 'Majalah')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(14)
            ->get();

        $majalahsTerbaru = Majalah::select('id', 'judul', 'kategori', 'deskripsi', 'release_date', 'user_id')
            ->where('kategori', 'Majalah')
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

        $majalah = Majalah::select('id', 'judul', 'deskripsi', 'kategori', 'deskripsi', 'release_date', 'user_id', 'media')
            ->with('user')
            ->where('visibilitas', 'public')
            ->where('id', $id)
            ->where('kategori', 'Majalah')
            ->first();

        if (!$majalah) {
            return abort(404, "Majalah tidak ditemukan.");
        }

        // Ambil jumlah like dan dislike
        $likeCount = Reaksi::where('item_id', $majalah->id)
            ->where('jenis_reaksi', 'Suka')
            ->where('reaksi_type', 'Produk')
            ->count();

        $dislikeCount = Reaksi::where('item_id', $majalah->id)
            ->where('jenis_reaksi', 'Tidak Suka')
            ->where('reaksi_type', 'Produk')
            ->count();

        // Reaksi pengguna saat ini
        $userReaksi = null;
        if (Auth::check()) {
            $userReaksi = Reaksi::where('user_id', Auth::user()->uid)
                ->where('item_id', $majalah->id)
                ->where('reaksi_type', 'Produk')
                ->first();
        }

        // Komentar & replies
        $komentarList = Komentar::with(['user', 'replies.user'])
            ->where('komentar_type', 'Produk')
            ->where('item_id', $majalah->id)
            ->whereNull('parent_id')
            ->orderBy('tanggal_komentar', 'desc')
            ->get();

        // Rekomendasi Majalah lain tanpa ambil media
        $rekomendasiMajalah = Majalah::select('id', 'judul', 'kategori', 'deskripsi', 'release_date', 'user_id')
            ->where('kategori', 'Majalah')
            ->where('visibilitas', 'public')
            ->where('id', '!=', $id)
            ->orderBy('release_date', 'desc')
            ->paginate(6);

        if ($request->ajax()) {
            return view('produk.partials.MajalahRekomendasi', compact('rekomendasiMajalah'))->render();
        }

        return view('produk.majalah_detail', compact(
            'majalah',
            'rekomendasiMajalah',
            'likeCount',
            'dislikeCount',
            'userReaksi',
            'komentarList'
        ));
    }

    // Preview PDF (embed halaman)
    public function pdfPreview($id)
    {
        $majalah = Majalah::select('media')->findOrFail($id);

        if (!$majalah || !$majalah->media) {
            return abort(404, "PDF tidak ditemukan.");
        }

        return Response::make($majalah->media, 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    // Download PDF
    public function download($id)
    {
        $majalah = Majalah::select('judul', 'media')->findOrFail($id);

        if (!$majalah || !$majalah->media) {
            return abort(404, "PDF tidak ditemukan.");
        }

        $filename = str_replace(' ', '_', $majalah->judul) . '.pdf';

        return Response::make($majalah->media, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    // Halaman preview khusus
    public function preview(Request $request)
    {
        $id = $request->query('f');

        $majalah = Majalah::select('id', 'judul', 'media')->findOrFail($id);

        if (!$majalah || !$majalah->media) {
            return abort(404, "Majalah tidak ditemukan.");
        }

        return view('produk.majalah_preview', compact('majalah'));
    }
}
