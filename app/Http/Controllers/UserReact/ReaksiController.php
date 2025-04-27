<?php

namespace App\Http\Controllers\UserReact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\News\Berita;
use App\Models\UserReact\Reaksi;

class ReaksiController extends Controller
{
    public function store(Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $request->validate([
            'jenis_reaksi' => 'required|in:Suka,Tidak Suka',
            'item_id' => 'required|string|max:255',
        ]);

        $berita = Berita::findOrFail($request->item_id);
        $userId = Auth::id();  // Ambil user_id yang sedang login

        // Periksa apakah user sudah memberikan reaksi
        $existingReaksi = $berita->reaksi()->where('user_id', $userId)->first();

        if ($existingReaksi) {
            // Jika sudah ada reaksi, update jenis reaksi
            $existingReaksi->update([
                'jenis_reaksi' => $request->jenis_reaksi,
                'tanggal_reaksi' => now(),
            ]);
        } else {
            // Jika belum ada reaksi, simpan reaksi baru
            $berita->reaksi()->create([
                'user_id' => $userId,
                'jenis_reaksi' => $request->jenis_reaksi,
                'tanggal_reaksi' => now(),
                'reaksi_type' => 'Berita',
                'item_id' => $berita->id,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
