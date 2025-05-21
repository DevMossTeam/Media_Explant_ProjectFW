<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Published;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PublishedController extends Controller
{
    public function index(Request $request)
    {
        $user = Session::get('user');
        Carbon::setLocale('id');

        $query = Published::where('user_id', $user->uid)
            ->where('visibilitas', 'public');

        // Filter judul jika ada pencarian
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Sorting
        if ($request->sort == 'asc') {
            $query->orderBy('judul', 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy('judul', 'desc');
        } else {
            $query->orderBy('tanggal_diterbitkan', 'desc');
        }

        $berita = $query->get()->map(function ($item) {
            preg_match('/<img.*?src=["\']([^"\']+)/', $item->konten_berita, $matches);
            $thumbnail = $matches[1] ?? asset('images/default-thumbnail.jpg');

            $tanggalDiterbitkan = Carbon::parse($item->tanggal_diterbitkan);
            $publishedAgo = $tanggalDiterbitkan->diffForHumans(now(), ['parts' => 1, 'syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW]);

            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'kategori' => $item->kategori,
                'thumbnail' => $thumbnail,
                'published_ago' => $publishedAgo,
                'tanggal_dibuat' => $item->tanggal_diterbitkan,
            ];
        });

        return view('authors.published', compact('berita'));
    }

    public function edit($id)
    {
        $user = session('user');

        $berita = Published::where('id', $id)
            ->where('user_id', $user->uid)
            ->firstOrFail();

        return view('authors.edit', compact('berita'));
    }

    public function destroy($id)
    {
        $user = session('user');

        $berita = Published::where('id', $id)
            ->where('user_id', $user->uid)
            ->firstOrFail();

        $berita->delete();

        return redirect()->route('published-media')->with('success', 'Berita berhasil dihapus.');
    }
}
