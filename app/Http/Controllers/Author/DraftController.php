<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Draft;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class DraftController extends Controller
{
    public function index(Request $request)
    {
        $user = Session::get('user');
        Carbon::setLocale('id');

        $query = Draft::where('user_id', $user->uid)
            ->where('visibilitas', 'private');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->sort == 'asc') {
            $query->orderBy('judul', 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy('judul', 'desc');
        } elseif ($request->sort == 'recent') {
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

        return view('authors.draft', compact('berita'));
    }

    public function edit($id)
    {
        $user = session('user');

        $berita = Draft::where('id', $id)
            ->where('user_id', $user->uid)
            ->firstOrFail();

        return view('authors.edit', compact('berita'));
    }

    public function destroy($id)
    {
        $user = session('user');

        $berita = Draft::where('id', $id)
            ->where('user_id', $user->uid)
            ->firstOrFail();

        $berita->delete();

        return redirect()->route('draft-media')->with('success', 'Draft berhasil dihapus.');
    }
}
