<?php

namespace App\Http\Controllers\API;

use App\Models\API\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BeritaController extends Controller
{
    // Fungsi bantu ambil limit & page dari query
    private function getPaginationParams(Request $request)
    {
        $limit = $request->query('limit', 10);
        $page = $request->query('page', 1);
        return [(int) $limit, (int) $page];
    }

    // Format response berita
    private function formatBeritaResponse($beritas, $userId)
    {
        return $beritas->map(function ($berita) use ($userId) {
            $tanggalDiterbitkan = Carbon::parse($berita->tanggal_diterbitkan);
            $profilePic = !empty($berita->user->profile_pic) ? base64_encode($berita->user->profile_pic) : null;

            return [
                'idBerita' => $berita->id,
                'judul' => $berita->judul,
                'kontenBerita' => $berita->konten_berita,
                'gambar' => $berita->gambar ?? null,
                'tanggalDibuat' => $tanggalDiterbitkan->toDateTimeString(),
                'penulis' => $berita->user->nama_lengkap ?? null,
                'profil' => $profilePic,
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

    public function getBeritaTerbaru(Request $request)
    {
        $userId = $request->query('user_id');
        [$limit, $page] = $this->getPaginationParams($request);

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->where('visibilitas', 'public')
            ->orderByDesc('tanggal_diterbitkan')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => $this->formatBeritaResponse($beritas, $userId)
        ]);
    }

    public function getBeritaPopuler(Request $request)
    {
        $userId = $request->query('user_id');
        [$limit, $page] = $this->getPaginationParams($request);

        $beritas = Berita::withCount(['reaksis as jumlah_like' => function ($q) {
                $q->where('jenis_reaksi', 'Suka');
            }])
            ->with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->where('visibilitas', 'public')
            ->orderByDesc('jumlah_like')
            ->orderByDesc('view_count')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => $this->formatBeritaResponse($beritas, $userId)
        ]);
    }

    public function getBeritaTeratas(Request $request)
    {
        $userId = $request->query('user_id');

        $beritas = Berita::withCount(['reaksis as jumlah_like' => function ($q) {
                $q->where('jenis_reaksi', 'Suka');
            }])
            ->with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->where('visibilitas', 'public')
            ->orderByDesc('view_count')
            ->orderByDesc('jumlah_like')
            ->limit(1)
            ->get();

        return response()->json([
            'data' => $this->formatBeritaResponse($beritas, $userId)
        ]);
    }

    public function getBeritaTerkait(Request $request)
    {
        $userId = $request->query('user_id');
        $beritaId = $request->query('berita_id');
        $kategori = $request->query('kategori');
        [$limit, $page] = $this->getPaginationParams($request);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 400);
        }

        $beritaUtama = Berita::find($beritaId);
        if (!$beritaUtama) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->where('id', '!=', $beritaId)
            ->where('kategori', $kategori)
            ->where('visibilitas', 'public')
            ->orderByDesc('tanggal_diterbitkan')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => $this->formatBeritaResponse($beritas, $userId)
        ]);
    }

    public function getBeritaRekomendasi(Request $request)
    {
        $userId = $request->query('user_id');
        [$limit, $page] = $this->getPaginationParams($request);
        $kategoriFavorit = collect();

        if ($userId) {
            $kategoriFavorit = Berita::whereHas('bookmarks', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })->pluck('kategori')->unique();
        }

        if ($kategoriFavorit->isNotEmpty()) {
            $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                ->whereIn('kategori', $kategoriFavorit)
                ->where('visibilitas', 'public')
                ->inRandomOrder()
                ->paginate($limit, ['*'], 'page', $page);
        } else {
            $beritas = Berita::withCount(['reaksis as like_count' => function ($q) {
                    $q->where('jenis_reaksi', 'Suka');
                }])
                ->with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
                ->where('visibilitas', 'public')
                ->orderByDesc('view_count')
                ->orderByDesc('like_count')
                ->paginate($limit, ['*'], 'page', $page);
        }

        return response()->json([
            'data' => $this->formatBeritaResponse($beritas, $userId)
        ]);
    }

    public function getRekomendasiLainnya(Request $request)
    {
        $userId = $request->query('user_id');
        [$limit, $page] = $this->getPaginationParams($request);

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->where('visibilitas', 'public')
            ->whereDoesntHave('bookmarks', function ($q) use ($userId) {
                if ($userId) {
                    $q->where('user_id', $userId);
                }
            })
            ->inRandomOrder()
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => $this->formatBeritaResponse($beritas, $userId)
        ]);
    }

    public function searchBerita(Request $request)
    {
        $userId = $request->query('user_id');
        $query = $request->query('q');
        [$limit, $page] = $this->getPaginationParams($request);

        if (!$query) {
            return response()->json(['message' => 'Query pencarian tidak boleh kosong'], 400);
        }

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->where('visibilitas', 'public')
            ->where(function ($q) use ($query) {
                $q->where('judul', 'like', "%$query%")
                    ->orWhere('konten_berita', 'like', "%$query%")
                    ->orWhere('kategori', 'like', "%$query%");
            })
            ->orderByDesc('tanggal_diterbitkan')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => $this->formatBeritaResponse($beritas, $userId)
        ]);
    }

    public function searchByKategori(Request $request)
    {
        $userId = $request->query('user_id');
        $kategori = $request->query('kategori');
        [$limit, $page] = $this->getPaginationParams($request);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak boleh kosong'], 400);
        }

        $beritas = Berita::with(['tags', 'bookmarks', 'reaksis', 'komentars', 'user'])
            ->where('visibilitas', 'public')
            ->where('kategori', 'like', "%$kategori%")
            ->orderByDesc('tanggal_diterbitkan')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data' => $this->formatBeritaResponse($beritas, $userId)
        ]);
    }
}


// php artisan serve --host=0.0.0.0 --port=8000