<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile\Liked;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class LikedController extends Controller
{
    public function index(Request $request)
    {
        $user = Session::get('user');
        Carbon::setLocale('id');

        $query = Liked::with('berita')
            ->where('jenis_reaksi', 'Suka')
            ->where('user_id', $user->uid);

        // Filter pencarian berdasarkan judul berita
        if ($request->filled('search')) {
            $query->whereHas('berita', function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        if ($request->sort == 'asc') {
            $query->orderBy(\App\Models\Author\Published::select('judul')->whereColumn('id', 'reaksi.item_id'), 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy(\App\Models\Author\Published::select('judul')->whereColumn('id', 'reaksi.item_id'), 'desc');
        } else {
            // Default ke Terbaru (Tanggal Reaksi)
            $query->orderBy('tanggal_reaksi', 'desc');
        }

        $likedItems = $query->get()
            ->filter(fn($liked) => $liked->berita && $liked->berita->visibilitas === 'public')
            ->map(function ($liked) {
                $berita = $liked->berita;
                preg_match('/<img.*?src=["\']([^"\']+)/', $berita->konten_berita, $matches);
                $thumbnail = $matches[1] ?? asset('images/default-thumbnail.jpg');

                return [
                    'id' => $berita->id,
                    'judul' => $berita->judul,
                    'kategori' => $berita->kategori,
                    'thumbnail' => $thumbnail,
                    'tanggal_disukai' => $liked->tanggal_reaksi,
                    'disukai_ago' => Carbon::parse($liked->tanggal_reaksi)->diffForHumans(),
                ];
            });

        return view('profile.liked', ['likedItems' => $likedItems]);
    }

    public function destroy($id)
    {
        $user = Session::get('user');

        $liked = Liked::where('user_id', $user->uid)
            ->where('item_id', $id)
            ->where('jenis_reaksi', 'Suka')
            ->firstOrFail();

        $liked->delete();

        return redirect()->route('liked')->with('success', 'Berhasil dihapus dari daftar disukai.');
    }
}
