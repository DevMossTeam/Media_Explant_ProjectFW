<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use App\Models\Karya\Puisi;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Reaksi;
use App\Models\UserReact\Komentar;

class PuisiController extends Controller
{
    public function index()
    {
        $terbaru = Puisi::where('kategori', 'puisi')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(6)
            ->get();

        $karya = Puisi::with('user')
            ->where('kategori', 'puisi')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(20)
            ->get();

        return view('karya.puisi', compact('terbaru', 'karya'));
    }

    public function show()
    {
        $id = request()->get('k');

        $karya = Puisi::with('user')
            ->where('id', $id)
            ->where('kategori', 'puisi')
            ->where('visibilitas', 'public')
            ->firstOrFail();

        $rekomendasi = Puisi::with('user')
            ->where('id', '!=', $id)
            ->where('kategori', 'puisi')
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->take(6)
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

        return view('karya.detail.puisi-detail', compact('karya', 'rekomendasi', 'likeCount', 'dislikeCount', 'komentarList', 'userReaksi'));
    }
}
