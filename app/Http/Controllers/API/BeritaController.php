<?php

namespace App\Http\Controllers\API;

use App\Models\API\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BeritaController extends Controller
{


    public function getAllBerita()
    {
        // Mendapatkan semua berita dengan relasi yang diperlukan
        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars'])->get();
    
        // Menyiapkan data untuk response
        $response = $beritas->map(function ($berita) {
            $userId = Auth::id(); // Mendapatkan ID user yang sedang login
    
            $tanggalDiterbitkan = Carbon::parse($berita->tanggal_diterbitkan);
    
            return [
                'idBerita' => $berita->id,
                'judul' => $berita->judul,
                'kontenBerita' => $berita->konten_berita,
                'gambar' => $berita->gambar ?? null,
                'tanggalDibuat' => $tanggalDiterbitkan->toDateTimeString(),
                'penulis' => $berita->user_id,
                'profil' => $berita->user->profile_pic ?? null,
                'kategori' => $berita->kategori,
                'jumlahLike' => $berita->reaksis->where('jenis_reaksi', 'Suka')->count(),
                'jumlahDislike' => $berita->reaksis->where('jenis_reaksi', 'Tidak Suka')->count(),
                'jumlahKomentar' => $berita->komentars->count(),
                'tags' => $berita->tags->pluck('nama_tag'),
                'isBookmark' => $berita->bookmarks->where('user_id', $userId)->count() > 0,
                'isLike' => $berita->reaksis->where('user_id', $userId)->where('jenis_reaksi', 'Suka')->count() > 0,
                'isDislike' => $berita->reaksis->where('user_id', $userId)->where('jenis_reaksi', 'Tidak Suka')->count() > 0,
            ];
        });
    
        return response()->json($response);
    }
    
}