<?php

namespace App\Http\Controllers\UserReact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\News\Berita;
use App\Models\Reaksi;

class ReaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jenis_reaksi' => 'required|in:Suka,Tidak Suka',
            'item_id' => 'required|string|max:255',
        ]);

        $berita = Berita::findOrFail($request->item_id);

        $berita->reaksi()->create([
            'id' => Str::random(12),
            'user_id' => Auth::id(),
            'jenis_reaksi' => $request->jenis_reaksi,
            'tanggal_reaksi' => now(),
        ]);

        return response()->json([
            'message' => 'Reaksi berhasil disimpan.'
        ]);
    }
}
