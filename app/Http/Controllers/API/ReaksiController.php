<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Berita\Reaksi;
use Illuminate\Http\Request;

class ReaksiController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|exists:user,uid',
            'berita_id' => 'required|string|exists:berita,id',
            'jenis_reaksi' => 'required|in:Suka,Tidak Suka'
        ]);

        $existing = Reaksi::where('user_id', $request->user_id)
                          ->where('berita_id', $request->berita_id)
                          ->first();

        if ($existing) {
            if ($existing->jenis_reaksi === $request->jenis_reaksi) {
                $existing->delete();

                return response()->json([
                    'status' => 'removed',
                    'message' => 'Reaksi dihapus.'
                ]);
            } else {
                $existing->jenis_reaksi = $request->jenis_reaksi;
                $existing->tanggal_reaksi = now();
                $existing->save();

                return response()->json([
                    'status' => 'updated',
                    'message' => 'Reaksi diperbarui.',
                    'data' => $existing
                ]);
            }
        } else {
            $reaksi = Reaksi::create([
                'user_id' => $request->user_id,
                'berita_id' => $request->berita_id,
                'jenis_reaksi' => $request->jenis_reaksi,
            ]);

            return response()->json([
                'status' => 'added',
                'message' => 'Reaksi ditambahkan.',
                'data' => $reaksi
            ]);
        }
    }
}
