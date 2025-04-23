<?php
namespace App\Http\Controllers\API;

use App\Models\API\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BeritaController extends Controller
{
    // Mengambil semua berita
    public function getAllBerita(Request $request)
    {
        $userId = $request->query('user_id');
        $userId = $userId ? $userId : null;

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])->get();
        return response()->json($this->formatBeritaResponse($beritas, $userId));
    }

    // Mengambil berita terbaru
    public function getBeritaTerbaru(Request $request)
    {
        $userId = $request->query('user_id');
        $userId = $userId ? $userId : null;
        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                    ->orderByDesc('tanggal_diterbitkan')
                    ->limit(10)
                    ->get();
        return response()->json($this->formatBeritaResponse($beritas, $userId));
    }

    // Mengambil berita populer (berdasarkan jumlah "like" atau reaksi positif).
    public function getBeritaPopuler(Request $request)
    {
        $userId = $request->query('user_id');
        $userId = $userId ? $userId : null;

        $beritas = Berita::withCount(['reaksis as jumlah_like' => function ($q) {
                            $q->where('jenis_reaksi', 'Suka');
                        }])
                        ->with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                        ->orderByDesc('jumlah_like')
                        ->orderByDesc('view_count')
                        ->limit(10)
                        ->get();
        return response()->json($this->formatBeritaResponse($beritas, $userId));
    }

    public function getBeritaTerkait(Request $request)
{
    $beritaId = $request->query('berita_id');

    // Ambil berita utama berdasarkan ID
    $beritaUtama = Berita::with('tags')->find($beritaId);

    if (!$beritaUtama) {
        return response()->json(['message' => 'Berita tidak ditemukan'], 404);
    }

    // Ambil tag id dari berita utama
    $tagIds = $beritaUtama->tags->pluck('id')->toArray();

    // Ambil berita terkait berdasarkan kategori atau tag yang sama, dan pastikan bukan berita utama
    $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
        ->where('id', '!=', $beritaId) // Pastikan berita utama tidak muncul
        ->where(function ($query) use ($beritaUtama, $tagIds) {
            $query->where('kategori', $beritaUtama->kategori)
                ->orWhereHas('tags', function ($q) use ($tagIds) {
                    $q->whereIn('id', $tagIds);
                });
        })
        ->inRandomOrder()
        ->limit(6)
        ->get();

    return response()->json($this->formatBeritaResponse($beritas, null)); // Tidak perlu user_id lagi
}


    public function getBeritaRekomendasi(Request $request)
{
    $userId = $request->query('user_id');

    // Ambil kategori berita yang pernah dibookmark user (jika user login)
    $kategoriFavorit = collect();

    if ($userId) {
        $kategoriFavorit = Berita::whereHas('bookmarks', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->pluck('kategori')->unique();
    }

    // Jika ada kategori favorit, ambil berita berdasarkan kategori tersebut
    if ($kategoriFavorit->isNotEmpty()) {
        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                    ->whereIn('kategori', $kategoriFavorit)
                    ->inRandomOrder()
                    ->limit(10)
                    ->get();
    } else {
        // Jika tidak ada (user belum login atau belum pernah bookmark), ambil berdasarkan view & like
        $beritas = Berita::withCount([
                        'reaksis as like_count' => function ($q) {
                            $q->where('jenis_reaksi', 'Suka');
                        }
                    ])
                    ->orderByDesc('view_count')
                    ->orderByDesc('like_count')
                    ->with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                    ->limit(10)
                    ->get();
    }

    return response()->json($this->formatBeritaResponse($beritas, $userId));
}



    // Mengambil berita lain yang belum dibookmark oleh pengguna.
    public function getRekomendasiLainnya(Request $request)
    {
        $userId = $request->query('user_id');
        $userId = $userId ? $userId : null;

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                    ->whereDoesntHave('bookmarks', function ($q) use ($userId) {
                        if ($userId) {
                            $q->where('user_id', $userId);
                        }
                    })
                    ->inRandomOrder()
                    ->limit(5)
                    ->get();
        return response()->json($this->formatBeritaResponse($beritas, $userId));
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
