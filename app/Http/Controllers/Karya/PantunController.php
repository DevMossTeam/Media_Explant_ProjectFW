<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karya\Pantun;

class PantunController extends Controller
{
    public function index()
    {
        $terbaru = Pantun::where('kategori', 'pantun')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(6)
            ->get();

        $karya = Pantun::with('user')
            ->where('kategori', 'pantun')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take(20)
            ->get();

        return view('karya.pantun', compact('terbaru', 'karya'));
    }
}
