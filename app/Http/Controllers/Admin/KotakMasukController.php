<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\API\Pesan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class KotakMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesan::with('user');
    
        if ($request->has('filter')) {
            $filter = $request->input('filter');
            if ($filter === 'masukan') {
                $query->where('status', 'masukan');
            } elseif ($filter === 'laporan') {
                $query->where('status', 'laporan');
            } elseif ($filter === 'showAll') {
                $query = Pesan::with('user');
            } elseif ($filter === 'starred') {
                $query->where('star', 'iya');
            } elseif ($filter === 'terbaru') {
                $query->whereDate('created_at', now());
            }
        }
    
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('pesan', 'like', "%$search%")
                  ->orWhereHas('user', function ($user) use ($search) {
                      $user->where('name', 'like', "%$search%");
                  });
            });
        }
    
        $perPage = $request->input('perPage', 150);
        $pesans = $query->paginate($perPage);
    
        return view('dashboard-admin.menu.kotak_masuk', compact('pesans'));
    }

    // Detail pesan
    public function show($id)
    {
        $pesan = Pesan::with('user')->find($id);
        if (!$pesan) abort(404);

        return view('dashboard-admin.menu.detail_kotak_masuk', compact('pesan'));
    }

    // Hapus pesan secara bulk
    public function destroy(Request $request)
    {
        // Get the message IDs directly as an array
        $ids = $request->input('message_ids');

        if (!is_array($ids) || empty($ids)) {
            return back()->with('error', 'Tidak ada pesan yang dipilih.');
        }

        // Delete selected messages
        Pesan::whereIn('id', $ids)->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }

    // Toggle bintang
    public function toggleStar($id)
    {
        $pesan = Pesan::find($id);
        if ($pesan) {
            $pesan->star = $pesan->star === 'iya' ? 'tidak' : 'iya';
            $pesan->save();
        }
        return response()->json(['status' => 'success']);
    }
}
