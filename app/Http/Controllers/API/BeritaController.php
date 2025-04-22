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
        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])->get();
        return response()->json($this->formatBeritaResponse($beritas, Auth::id()));
    }

    public function getBeritaTerbaru()
    {
        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                    ->orderByDesc('tanggal_diterbitkan')
                    ->limit(10)
                    ->get();

        return response()->json($this->formatBeritaResponse($beritas, Auth::id()));
    }

    public function getBeritaPopuler()
    {
        $beritas = Berita::withCount(['reaksis as jumlah_like' => function ($q) {
                            $q->where('jenis_reaksi', 'Suka');
                        }])
                        ->with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                        ->orderByDesc('jumlah_like')
                        ->limit(10)
                        ->get();

        return response()->json($this->formatBeritaResponse($beritas, Auth::id()));
    }

    public function getBeritaRekomendasi()
    {
        $userId = Auth::id();

        $kategoriFavorit = Berita::whereHas('bookmarks', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->pluck('kategori')->unique();

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                    ->whereIn('kategori', $kategoriFavorit)
                    ->inRandomOrder()
                    ->limit(10)
                    ->get();

        return response()->json($this->formatBeritaResponse($beritas, $userId));
    }

    public function getRekomendasiLainnya()
    {
        $userId = Auth::id();

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                    ->whereDoesntHave('bookmarks', function ($q) use ($userId) {
                        $q->where('user_id', $userId);
                    })
                    ->inRandomOrder()
                    ->limit(5)
                    ->get();

        return response()->json($this->formatBeritaResponse($beritas, $userId));
    }

    public function getBeritaTerkait($id)
    {
        $beritaUtama = Berita::with('tags')->findOrFail($id);
        $tagIds = $beritaUtama->tags->pluck('id');

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                    ->whereHas('tags', function ($q) use ($tagIds) {
                        $q->whereIn('tags.id', $tagIds);
                    })
                    ->where('id', '!=', $id)
                    ->limit(5)
                    ->get();

        return response()->json($this->formatBeritaResponse($beritas, Auth::id()));
    }

    private function formatBeritaResponse($beritas, $userId)
    {
        return $beritas->map(function ($berita) use ($userId) {
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
    }
}
