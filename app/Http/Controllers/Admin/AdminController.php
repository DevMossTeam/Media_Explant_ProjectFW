<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\API\Berita;
use App\Models\API\Karya;
use App\Models\API\Pesan;
use App\Models\API\Produk;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{  
    function index() {
        $usersCount = User::count();
        $produkCount = Produk::count();
        $KaryaCount = Karya::count();
        $beritaCount = Berita::count();
        $query = Pesan::with('user');

        return view('dashboard-admin.index', compact('usersCount', 'produkCount','KaryaCount', 'beritaCount'));
    }   
     
    public function performaKonten()
    {     
        $karyaPerTanggal = Karya::selectRaw('DATE(release_date) as tanggal, COUNT(*) as total')
        ->groupBy('tanggal')
        ->get();
        return view('dashboard-admin.performa', compact('data'));
    }
}
