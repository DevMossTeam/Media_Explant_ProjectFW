<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|exists:user,uid',
            'berita_id' => 'required|string|exists:berita,id',
        ]);

        $bookmark = Bookmark::where('user_id', $request->user_id)
                            ->where('berita_id', $request->berita_id)
                            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Bookmark dihapus.',
            ]);
        } else {
            $newBookmark = Bookmark::create([
                'user_id' => $request->user_id,
                'berita_id' => $request->berita_id,
            ]);

            return response()->json([
                'status' => 'added',
                'message' => 'Bookmark ditambahkan.',
                'data' => $newBookmark
            ]);
        }
    }
}


