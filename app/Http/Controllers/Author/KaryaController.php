<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Karya;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KaryaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:10240',
            'visibilitas' => 'required|in:public,private',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('karya_media', 'public');
        }

        Karya::create([
            'id' => Str::random(12),
            'creator' => $request->penulis,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'media' => $filePath,
            'release_date' => now(),
            'visibilitas' => $request->visibilitas,
        ]);

        return redirect()->back()->with('success', 'Karya berhasil dipublikasikan!');
    }
}
