<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karya\Pantun;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Reaksi;
use App\Models\UserReact\Komentar;

class PantunController extends Controller
{
    public function index()
    {
        $terbaru = Pantun::where('kategori', 'pantun')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(6)
            ->get();

        $karya = Pantun::with('user')
            ->where('kategori', 'pantun')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(20)
            ->get();

        return view('karya.pantun', compact('terbaru', 'karya'));
    }

    public function show()
    {
        $id = request()->get('k');

        $karya = Pantun::with('user')
            ->where('id', $id)
            ->where('kategori', 'pantun')
            ->where('visibilitas', 'public')
            ->firstOrFail();

        $rekomendasi = Pantun::with('user')
            ->where('id', '!=', $id)
            ->where('kategori', 'pantun')
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

        return view('karya.detail.pantun-detail', compact('karya', 'rekomendasi', 'likeCount', 'dislikeCount', 'komentarList', 'userReaksi'));
    }
}
