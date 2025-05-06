<?php

namespace App\Http\Controllers\UserReact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserReact\Komentar;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
            'item_id' => 'required|string',
            'komentar_type' => 'required|string',
            'parent_id' => 'nullable|string'
        ]);

        $user_uid = Cookie::get('user_uid');
        if (!$user_uid) return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);

        $user = User::where('uid', $user_uid)->first();
        if (!$user) return response()->json(['success' => false, 'message' => 'User not found'], 401);

        $komentar = Komentar::create([
            'id' => Str::random(12),
            'user_id' => $user->uid,
            'isi_komentar' => $request->komentar,
            'tanggal_komentar' => Carbon::now(),
            'komentar_type' => $request->komentar_type,
            'item_id' => $request->item_id,
            'parent_id' => $request->parent_id ?? null
        ]);

        return response()->json([
            'success' => true,
            'isi_komentar' => $komentar->isi_komentar,
            'nama_pengguna' => $user->nama_pengguna,
            'parent_id' => $komentar->parent_id,
            'id' => $komentar->id
        ]);
    }

    public function fetch($item_id)
    {
        $komentar = Komentar::with('user')
            ->where('item_id', $item_id)
            ->where('komentar_type', 'Berita')
            ->latest('tanggal_komentar')
            ->get();

        return response()->json($komentar);
    }
}
