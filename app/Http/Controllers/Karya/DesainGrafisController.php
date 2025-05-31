<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use App\Models\Karya\DesainGrafis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Reaksi;
use App\Models\UserReact\Komentar;

class DesainGrafisController extends Controller
{
    // Menampilkan daftar karya desain grafis
    public function index()
    {
        $karya = DesainGrafis::with('user')
            ->where('kategori', 'desain_grafis')
            ->where('visibilitas', 'public')
            ->withCount([
                'reaksiSuka as like_count'
            ])
            ->orderBy('release_date', 'desc')
            ->paginate(12);

        return view('karya.desain-grafis', compact('karya'));
    }

    // Menampilkan detail karya
    public function show()
    {
        $id = request()->get('k');

        $karya = DesainGrafis::with('user')
            ->where('id', $id)
            ->where('kategori', 'desain_grafis')
            ->where('visibilitas', 'public')
            ->firstOrFail();

        $karya->increment('view_count');

        $rekomendasi = DesainGrafis::with('user')
            ->where('id', '!=', $id)
            ->where('kategori', 'desain_grafis')
            ->where('visibilitas', 'public')
            ->inRandomOrder()
            ->take(4)
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

        return view('karya.detail.desainGrafis-detail', compact('karya', 'rekomendasi', 'likeCount', 'dislikeCount', 'komentarList', 'userReaksi'));
    }
}
