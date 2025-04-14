<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Berita\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function getAllBerita()
    {
        $beritas = Berita::with(['user', 'komentar', 'reaksi', 'tag', 'bookmark'])
            ->get()
            ->map(function($berita) {
                return [
                    'idBerita' => $berita->id,
                    'judul' => $berita->judul,
                    'kontenBerita' => $berita->konten_berita,
                    'gambar' => $berita->gambar,
                    'tanggalDibuat' => $berita->tanggal_diterbitkan,
                    'penulis' => $berita->user->nama_pengguna,
                    'profil' => $berita->user->profile_pic,
                    'kategori' => $berita->kategori,
                    'jumlahLike' => $berita->reaksi->where('jenis_reaksi', 'Suka')->count(),
                    'jumlahDislike' => $berita->reaksi->where('jenis_reaksi', 'Tidak Suka')->count(),
                    'jumlahKomentar' => $berita->komentar->count(),
                    'tags' => $berita->tag->pluck('nama_tag')->toArray(),
                    'isBookmark' => $berita->bookmark->where('user_id', auth()->id())->isNotEmpty(),
                    'isLike' => $berita->reaksi->where('user_id', auth()->id())->where('jenis_reaksi', 'Suka')->isNotEmpty(),
                    'isDislike' => $berita->reaksi->where('user_id', auth()->id())->where('jenis_reaksi', 'Tidak Suka')->isNotEmpty()
                ];
            });

        return response()->json($beritas);
    }
}

