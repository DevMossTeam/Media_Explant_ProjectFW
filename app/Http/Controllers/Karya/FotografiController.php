<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karya\Fotografi;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Reaksi;
use App\Models\UserReact\Komentar;

class FotografiController extends Controller
{
    public function index()
    {
        // 14 karya utama
        $karya = Fotografi::with('user')
            ->where('kategori', 'fotografi')
            ->where('visibilitas', 'public')
            ->latest('release_date')
            ->take(16)
            ->get();

        // 4 terbaru
        $terbaru = Fotografi::where('kategori', 'fotografi')
            ->where('visibilitas', 'public')
            ->latest('release_date')
            ->take(4)
            ->get();

        // 6 rekomendasi hari ini
        $rekomendasi = Fotografi::where('kategori', 'fotografi')
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('karya.fotografi', compact('karya', 'terbaru', 'rekomendasi'));
    }

    public function show()
    {
        $id = request()->get('k');

        $karya = Fotografi::with('user')
            ->where('id', $id)
            ->where('kategori', 'fotografi')
            ->where('visibilitas', 'public')
            ->firstOrFail();

        $rekomendasi = Fotografi::with('user')
            ->where('id', '!=', $id)
            ->where('kategori', 'fotografi')
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->take(12)
            ->get();

        $komentarList = Komentar::with(['user', 'replies.user'])
            ->where('komentar_type', 'Karya')
            ->where('item_id', $karya->id)
            ->whereNull('parent_id')
            ->orderBy('tanggal_komentar', 'desc')
            ->get();

        $likeCount = Reaksi::where('item_id', $karya->id)
            ->where('jenis_reaksi', 'Suka')
            ->where('reaksi_type', 'Karya')
            ->count();

        $dislikeCount = Reaksi::where('item_id', $karya->id)
            ->where('jenis_reaksi', 'Tidak Suka')
            ->where('reaksi_type', 'Karya')
            ->count();

        $userReaksi = null;
        if (Auth::check()) {
            $userReaksi = Reaksi::where('user_id', Auth::user()->uid)
                ->where('item_id', $karya->id)
                ->where('reaksi_type', 'Karya')
                ->first();
        }

        return view('karya.detail.fotografi-detail', compact('karya', 'rekomendasi', 'likeCount', 'dislikeCount', 'komentarList', 'userReaksi'));
    }
}
