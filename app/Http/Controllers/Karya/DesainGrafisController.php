<?php

namespace App\Http\Controllers\Karya;

use App\Http\Controllers\Controller;
use App\Models\Karya\DesainGrafis;
use Illuminate\Http\Request;

class DesainGrafisController extends Controller
{
    public function index()
    {
        $karya = DesainGrafis::with('user')
            ->where('kategori', 'desain_grafis')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->paginate(12); 

        return view('karya.desain-grafis', compact('karya'));
    }
}
