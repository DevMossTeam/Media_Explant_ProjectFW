<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile\Bookmarked;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class BookmarkedController extends Controller
{
    public function index(Request $request)
    {
        $user = Session::get('user');
        Carbon::setLocale('id');

        $query = Bookmarked::with('berita')
            ->where('user_id', $user->uid);

        // Filter pencarian berdasarkan judul berita
        if ($request->filled('search')) {
            $query->whereHas('berita', function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        if ($request->sort == 'asc') {
            $query->orderBy(\App\Models\Author\Published::select('judul')->whereColumn('id', 'bookmark.item_id'), 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy(\App\Models\Author\Published::select('judul')->whereColumn('id', 'bookmark.item_id'), 'desc');
        } else {
            $query->orderBy('tanggal_bookmark', 'desc'); // Default terbaru
        }

        $bookmarkedItems = $query->get()
            ->filter(fn($bookmark) => $bookmark->berita && $bookmark->berita->visibilitas === 'public')
            ->map(function ($bookmark) {
                $berita = $bookmark->berita;
                preg_match('/<img.*?src=["\']([^"\']+)/', $berita->konten_berita, $matches);
                $thumbnail = $matches[1] ?? asset('images/default-thumbnail.jpg');

                return [
                    'id' => $berita->id,
                    'judul' => $berita->judul,
                    'kategori' => $berita->kategori,
                    'thumbnail' => $thumbnail,
                    'tanggal_disimpan' => $bookmark->tanggal_bookmark,
                    'disimpan_ago' => Carbon::parse($bookmark->tanggal_bookmark)->diffForHumans(),
                ];
            });

        return view('profile.bookmarked', ['bookmarkedItems' => $bookmarkedItems]);
    }

    public function destroy($id)
    {
        $user = Session::get('user');

        $bookmark = Bookmarked::where('user_id', $user->uid)
            ->where('item_id', $id)
            ->firstOrFail();

        $bookmark->delete();

        return redirect()->route('bookmarked')->with('success', 'Berhasil dihapus dari daftar bookmark.');
    }
}
