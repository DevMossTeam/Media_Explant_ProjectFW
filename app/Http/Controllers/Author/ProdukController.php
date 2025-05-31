<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Produk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukController extends Controller
{
    public function create()
    {
        return view('author.create-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'kategori' => 'required|in:Buletin,Majalah',
            'media' => 'required|file|mimes:pdf|max:10240',
            'cover' => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'visibilitas' => 'required|in:public,private',
        ]);

        // Ambil file dalam bentuk binary
        $mediaFile = $request->file('media');
        $mediaContent = file_get_contents($mediaFile->getRealPath());

        $coverFile = $request->file('cover');
        $coverContent = file_get_contents($coverFile->getRealPath());
        $coverBase64 = 'data:' . $coverFile->getMimeType() . ';base64,' . base64_encode($coverContent);

        $userUid = $request->cookie('user_uid');

        try {
            DB::table('produk')->insert([
                'id' => Str::random(12),
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'user_id' => $userUid,
                'media' => $mediaContent,
                'cover' => $coverBase64,
                'release_date' => now(),
                'visibilitas' => $request->visibilitas,
            ]);

            return redirect()->back()->with('success', 'Produk berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }
}
