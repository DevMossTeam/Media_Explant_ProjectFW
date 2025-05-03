<?php

namespace App\Http\Controllers\UserReact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserReact\Reaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReaksiController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id();
        $existing = Reaksi::where('user_id', $userId)
                          ->where('item_id', $request->item_id)
                          ->where('reaksi_type', $request->reaksi_type)
                          ->first();

        if ($existing) {
            // Toggle behavior
            if ($existing->jenis_reaksi === $request->jenis_reaksi) {
                $existing->delete();
                return response()->json(['status' => 'deleted']);
            } else {
                $existing->jenis_reaksi = $request->jenis_reaksi;
                $existing->tanggal_reaksi = now();
                $existing->save();
                return response()->json(['status' => 'updated']);
            }
        } else {
            Reaksi::create([
                'user_id' => $userId,
                'jenis_reaksi' => $request->jenis_reaksi,
                'tanggal_reaksi' => now(),
                'reaksi_type' => $request->reaksi_type,
                'item_id' => $request->item_id
            ]);
            return response()->json(['status' => 'created']);
        }
    }

    public function getCounts(Request $request)
    {
        $likes = Reaksi::where('item_id', $request->item_id)
                    ->where('reaksi_type', $request->reaksi_type)
                    ->where('jenis_reaksi', 'Suka')
                    ->count();

        $dislikes = Reaksi::where('item_id', $request->item_id)
                    ->where('reaksi_type', $request->reaksi_type)
                    ->where('jenis_reaksi', 'Tidak Suka')
                    ->count();

        return response()->json([
            'likeCount' => $likes,
            'dislikeCount' => $dislikes
        ]);
    }
}
