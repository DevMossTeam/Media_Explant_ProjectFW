<?php

namespace App\Http\Controllers\UserReact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReact\Reaksi;

class ReaksiController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $request->validate([
            'jenis_reaksi' => 'required|in:Suka,Tidak Suka',
            'item_id' => 'required|string|max:255',
        ]);

        $userId = Auth::id();
        $itemId = $request->item_id;
        $reaksiType = 'Berita';

        $existingReaksi = Reaksi::where('user_id', $userId)
            ->where('item_id', $itemId)
            ->where('reaksi_type', $reaksiType)
            ->first();

        if ($existingReaksi) {
            if ($existingReaksi->jenis_reaksi == $request->jenis_reaksi) {
                $existingReaksi->delete();
            } else {
                $existingReaksi->update([
                    'jenis_reaksi' => $request->jenis_reaksi,
                    'tanggal_reaksi' => now(),
                ]);
            }
        } else {
            Reaksi::create([
                'id' => $this->generateId(12),
                'user_id' => $userId,
                'jenis_reaksi' => $request->jenis_reaksi,
                'reaksi_type' => $reaksiType,
                'item_id' => $itemId,
                'tanggal_reaksi' => now(),
            ]);
        }

        return response()->json(['success' => true]);
    }

    private function generateId($length = 12)
    {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }
}
