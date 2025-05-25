<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk\Buletin;
use Illuminate\Support\Facades\Response;
use App\Models\UserReact\Reaksi;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Komentar;

class BuletinController extends Controller
{
    // Menampilkan buletin utama dan daftar lainnya
    public function index()
    {
        // 3 buletin terbaru untuk "Produk Kami"
        $buletins = Buletin::select('id', 'judul', 'deskripsi', 'release_date', 'user_id')
            ->where('kategori', 'Buletin')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(3)
            ->get();

        // 9 buletin terbaru untuk "Terbaru"
        $buletinsTerbaru = Buletin::select('id', 'judul', 'release_date', 'user_id')
            ->where('kategori', 'Buletin')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(9)
            ->get();

        // 12 buletin rekomendasi terbaru
        $buletinsRekomendasi = Buletin::select('id', 'judul', 'release_date', 'user_id')
            ->where('kategori', 'Buletin')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(12)
            ->get();

        return view('produk.buletin', compact('buletins', 'buletinsTerbaru', 'buletinsRekomendasi'));
    }

    // Menampilkan halaman detail buletin dengan optimasi memori
    public function show(Request $request)
    {
        $id = $request->query('f');

        // Ambil buletin utama tanpa media besar, hanya kolom penting saja
        $buletin = Buletin::select('id', 'judul', 'deskripsi', 'release_date', 'user_id', 'kategori', 'visibilitas')
            ->where('visibilitas', 'public')
            ->where('id', $id)
            ->where('kategori', 'Buletin')
            ->first();

        if (!$buletin) {
            return abort(404, "Buletin tidak ditemukan.");
        }

        $buletin->increment('view_count');

        // Pagination rekomendasi buletin dengan limit dan tanpa eager loading user (jika user tidak dibutuhkan)
        $rekomendasiBuletin = Buletin::select('id', 'judul', 'release_date')
            ->where('kategori', 'Buletin')
            ->where('visibilitas', 'public')
            ->where('id', '!=', $id)
            ->orderBy('release_date', 'desc')
            ->paginate(6);

        // Ambil komentar utama dan balasan untuk 'Produk' (komentar_type)
        $komentarList = Komentar::with(['user', 'replies.user'])
            ->where('komentar_type', 'Produk')
            ->where('item_id', $buletin->id)
            ->whereNull('parent_id') // hanya komentar utama
            ->orderBy('tanggal_komentar', 'desc')
            ->get();

        // Hitung like dan dislike secara efisien dengan tambahan filter reaksi_type = Produk
        $likeCount = Reaksi::where('item_id', $buletin->id)
            ->where('jenis_reaksi', 'Suka')
            ->where('reaksi_type', 'Produk')
            ->count();

        $dislikeCount = Reaksi::where('item_id', $buletin->id)
            ->where('jenis_reaksi', 'Tidak Suka')
            ->where('reaksi_type', 'Produk')
            ->count();

        // Ambil reaksi user yang sudah login, dengan filter reaksi_type = Produk
        $userReaksi = null;
        if (Auth::check()) {
            $userReaksi = Reaksi::where('user_id', Auth::user()->uid)
                ->where('item_id', $buletin->id)
                ->where('reaksi_type', 'Produk')
                ->first();
        }

        // Jika AJAX untuk pagination rekomendasi
        if ($request->ajax()) {
            return view('produk.partials.BuletinRekomendasi', compact('rekomendasiBuletin'))->render();
        }

        // Tampilkan view lengkap dengan data hitung reaksi dan user reaksi
        return view('produk.buletin_detail', compact(
            'buletin',
            'komentarList',
            'rekomendasiBuletin',
            'likeCount',
            'dislikeCount',
            'userReaksi'
        ));
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

    // Download PDF
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

    // Preview PDF
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
