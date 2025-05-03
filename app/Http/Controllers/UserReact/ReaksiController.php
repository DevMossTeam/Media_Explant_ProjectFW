<?php

namespace App\Http\Controllers\UserReact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserReact\Reaksi;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReaksiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_reaksi' => 'required|in:Suka,Tidak Suka',
            'reaksi_type' => 'required|string',
            'item_id' => 'required|string',
        ]);

        $userId = auth()->id();

        // Hapus reaksi sebelumnya oleh user pada item yg sama
        Reaksi::where('user_id', $userId)
            ->where('reaksi_type', $validated['reaksi_type'])
            ->where('item_id', $validated['item_id'])
            ->delete();

        $reaksi = Reaksi::create([
            'user_id' => $userId,
            'jenis_reaksi' => $validated['jenis_reaksi'],
            'tanggal_reaksi' => Carbon::now(),
            'reaksi_type' => $validated['reaksi_type'],
            'item_id' => $validated['item_id'],
        ]);

        // Hitung total suka dan tidak suka
        $likeCount = Reaksi::where('reaksi_type', $validated['reaksi_type'])
                        ->where('item_id', $validated['item_id'])
                        ->where('jenis_reaksi', 'Suka')->count();
        $dislikeCount = Reaksi::where('reaksi_type', $validated['reaksi_type'])
                        ->where('item_id', $validated['item_id'])
                        ->where('jenis_reaksi', 'Tidak Suka')->count();

        return response()->json([
            'success' => true,
            'likeCount' => $likeCount,
            'dislikeCount' => $dislikeCount,
        ]);
    }
}
