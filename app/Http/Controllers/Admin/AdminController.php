<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\API\Berita;
use App\Models\API\Karya;
use App\Models\API\Komentar;
use App\Models\API\Pesan;
use App\Models\API\Produk;
use App\Models\API\Reaksi;
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
     
    public function performaKonten(Request $request)
    {
        // Test mode toggle - add ?test=1 to URL to activate        

        // Determine selected period
        $period = $request->input('period', '7_hari'); // Default to 7 days

        // Date range calculation
        $dateRange = match ($period) {
            'bulan' => now()->subMonths(6)->startOfMonth(),
            'tahun' => now()->subYears(6)->startOfYear(),
            default => now()->subDays(6),
        };

        // Common date formatting logic
        $getGroupBy = function ($column, $period) {
            switch ($period) {
                case 'bulan':
                    return "DATE_FORMAT($column, '%Y-%m') as tanggal";
                case 'tahun':
                    return "DATE_FORMAT($column, '%Y') as tanggal";
                default:
                    return "DATE($column) as tanggal";
            }
        };
    
        // Common date formatting logic
        $getGroupBy = function ($column, $period) {
            switch ($period) {
                case 'bulan':
                    return "DATE_FORMAT($column, '%Y-%m') as tanggal";
                case 'tahun':
                    return "DATE_FORMAT($column, '%Y') as tanggal";
                default:
                    return "DATE($column) as tanggal";
            }
        };
    
        // Karya Data
        $karyaGroupBy = $getGroupBy('release_date', $period);
        $karyaPerTanggal = Karya::where('release_date', '>=', $dateRange)
            ->selectRaw("$karyaGroupBy, COUNT(*) as total")
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
    
        // Produk Data
        $produkGroupBy = $getGroupBy('release_date', $period);
        $produkPerTanggal = Produk::where('release_date', '>=', $dateRange)
            ->selectRaw("$produkGroupBy, COUNT(*) as total")
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
    
        // Berita Data
        $beritaGroupBy = $getGroupBy('tanggal_diterbitkan', $period);
        $beritaPerTanggal = Berita::where('tanggal_diterbitkan', '>=', $dateRange)
            ->selectRaw("$beritaGroupBy, COUNT(*) as total")
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
    
        // Likes Data
        $likeGroupBy = $getGroupBy('tanggal_reaksi', $period);
        $likePerTanggal = Reaksi::where('tanggal_reaksi', '>=', $dateRange)
            ->where('jenis_reaksi', 'Suka')
            ->selectRaw("$likeGroupBy, COUNT(*) as total")
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
    
        // Dislikes Data
        $dislikeGroupBy = $getGroupBy('tanggal_reaksi', $period);
        $dislikePerTanggal = Reaksi::where('tanggal_reaksi', '>=', $dateRange)
            ->where('jenis_reaksi', 'Tidak Suka')
            ->selectRaw("$dislikeGroupBy, COUNT(*) as total")
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
    
        // Comments Data
        $commentGroupBy = $getGroupBy('tanggal_komentar', $period);
        $komentarPerTanggal = Komentar::where('tanggal_komentar', '>=', $dateRange)
            ->selectRaw("$commentGroupBy, COUNT(*) as total")
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
    
        // Totals
        $totalLike = Reaksi::where('tanggal_reaksi', '>=', $dateRange)
            ->where('jenis_reaksi', 'Suka')
            ->count();
    
        $totalDislike = Reaksi::where('tanggal_reaksi', '>=', $dateRange)
            ->where('jenis_reaksi', 'Tidak Suka')
            ->count();
    
        $totalKomentar = Komentar::where('tanggal_komentar', '>=', $dateRange)->count();
    
        return view('dashboard-admin.menu.analitik.konten', compact(
            'karyaPerTanggal',
            'produkPerTanggal',
            'beritaPerTanggal',
            'likePerTanggal',
            'dislikePerTanggal',
            'komentarPerTanggal',
            'totalLike',
            'totalDislike',
            'totalKomentar',
            'period'
        ));
    }
}

