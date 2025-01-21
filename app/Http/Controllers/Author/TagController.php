<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Tambah tag baru (opsional jika ingin menambahkan tag secara terpisah).
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_tag' => 'required|string|max:15',
            'artikel_id' => 'required|string|exists:artikel,id', // Pastikan artikel_id valid
        ]);

        // Buat ID untuk tag
        $tagId = Str::random(12);

        // Simpan tag
        $tag = Tag::create([
            'id' => $tagId,
            'nama_tag' => $request->nama_tag,
            'artikel_id' => $request->artikel_id,
        ]);

        return response()->json([
            'message' => 'Tag berhasil ditambahkan!',
            'tag' => $tag,
        ]);
    }

    /**
     * Hapus tag (opsional jika ingin menghapus tag secara terpisah).
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        return response()->json([
            'message' => 'Tag berhasil dihapus!',
        ]);
    }
}
