<?php

namespace App\Http\Controllers\API;

use App\Models\API\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BeritaController extends Controller
{

    // Mengambil berita terbaru
    public function getBeritaTerbaru(Request $request)
    {
        $userId = $request->query('user_id');
        $userId = $userId ? $userId : null;
        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->orderByDesc('tanggal_diterbitkan')
            ->where('visibilitas', 'public')
            ->paginate(10);
        return response()->json($this->formatBeritaResponse($beritas, $userId));
    }

    // Mengambil berita populer (berdasarkan jumlah "like".
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
            ->where('visibilitas', 'public')
            ->limit(5)
            ->get();
        return response()->json($this->formatBeritaResponse($beritas, $userId));
    }

    public function getBeritaTerkait(Request $request)
    {
        // Ambil parameter dari query string
        $userId = $request->query('user_id');
        $beritaId = $request->query('berita_id');
        $kategori = $request->query('kategori'); // kategori sebagai parameter

        // Pastikan kategori ada dalam parameter
        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 400);
        }

        // Ambil berita utama berdasarkan ID
        $beritaUtama = Berita::find($beritaId);

        if (!$beritaUtama) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        // Ambil berita terkait berdasarkan kategori yang sama dan pastikan bukan berita utama
        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->where('id', '!=', $beritaId) // Pastikan berita utama tidak muncul
            ->where('kategori', $kategori) // Filter berdasarkan kategori yang sama
            ->orderByDesc('tanggal_diterbitkan')
            ->where('visibilitas', 'public')
            ->paginate(10);

        // Format dan kembalikan response
        return response()->json($this->formatBeritaResponse($beritas, $userId));
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
                ->where('visibilitas', 'public')
                ->inRandomOrder()
                ->paginate(10);
        } else {
            // Jika tidak ada (user belum login atau belum pernah bookmark), ambil berdasarkan view & like
            $beritas = Berita::withCount([
                'reaksis as like_count' => function ($q) {
                    $q->where('jenis_reaksi', 'Suka');
                }
            ])
                ->orderByDesc('view_count')
                ->orderByDesc('like_count')
                ->where('visibilitas', 'public')
                ->with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                ->paginate(10);
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
            ->where('visibilitas', 'public')
            ->get();
        return response()->json($this->formatBeritaResponse($beritas, $userId));
    }

    // search  
    public function searchBerita(Request $request)
    {
        $userId = $request->query('user_id');
        $query = $request->query('q');

        if (!$query) {
            return response()->json(['message' => 'Query pencarian tidak boleh kosong'], 400);
        }

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->where('visibilitas', 'public')
            ->where(function ($q) use ($query) {
                $q->where('judul', 'like', '%' . $query . '%')
                    ->orWhere('konten_berita', 'like', '%' . $query . '%')
                    ->orWhere('kategori', 'like', '%' . $query . '%');
            })
            ->orderByDesc('tanggal_diterbitkan')
            ->paginate(10);

        return response()->json($this->formatBeritaResponse($beritas, $userId));
    }

    // search by kategori
    public function searchByKategori(Request $request)
    {
        $userId = $request->query('user_id');
        $kategori = $request->query('kategori');

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak boleh kosong'], 400);
        }

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->where('visibilitas', 'public')
            ->where('kategori', 'like', '%' . $kategori . '%')
            ->orderByDesc('tanggal_diterbitkan')
            ->paginate(10);

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
                'penulis' => $berita->user->nama_lengkap ?? null,
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

// php artisan serve --host=0.0.0.0 --port=8000
