<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use App\Models\Karya\Syair;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Reaksi;
use App\Models\UserReact\Komentar;

class SyairController extends Controller
{
    public function index()
    {
        $terbaru = Syair::where('kategori', 'syair')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(6)
            ->get();

        $karya = Syair::with('user')
            ->where('kategori', 'syair')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(20)
            ->get();

        return view('karya.syair', compact('terbaru', 'karya'));
    }

    public function show()
    {
        $id = request()->get('k');

        $karya = Syair::with('user')
            ->where('id', $id)
            ->where('kategori', 'syair')
            ->where('visibilitas', 'public')
            ->firstOrFail();

        $rekomendasi = Syair::with('user')
            ->where('id', '!=', $id)
            ->where('kategori', 'syair')
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

        return view('karya.detail.syair-detail', compact('karya', 'rekomendasi', 'likeCount', 'dislikeCount', 'komentarList', 'userReaksi'));
    }
}
