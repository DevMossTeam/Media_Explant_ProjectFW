<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Published;
use Illuminate\Support\Facades\Cookie;

class PublishedController extends Controller
{
    public function index()
    {
        $userUid = Cookie::get('user_uid');

        $berita = Published::where('visibilitas', 'public')
            ->where('user_id', $userUid)
            ->orderByDesc('tanggal_diterbitkan')
            ->get()
            ->map(function ($item) {
                $firstImage = '';
                preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $item->konten_berita, $image);
                if (isset($image['src'])) {
                    $firstImage = $image['src'];
                }

                return [
                    'judul' => $item->judul,
                    'kategori' => $item->kategori,
                    'thumbnail' => $firstImage,
                    'tanggal' => \Carbon\Carbon::parse($item->tanggal_diterbitkan)->translatedFormat('d F Y'),
                    'published_ago' => \Carbon\Carbon::parse($item->tanggal_diterbitkan)->diffForHumans(),
                ];
            });

        return view('authors.published', compact('berita'));
    }
}
