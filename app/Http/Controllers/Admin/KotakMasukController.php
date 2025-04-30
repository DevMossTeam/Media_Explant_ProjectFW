<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\API\Pesan;

class KotakMasukController extends Controller
{
    // Tampilkan semua pesan
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $pesans = Pesan::paginate($perPage);

        return view('dashboard-admin.menu.kotak_masuk', compact('pesans', 'perPage'));
    }

    // Tampilkan detail satu pesan
    public function show($id)
    {
        $pesan = Pesan::find($id);

        if (!$pesan) {
            return redirect()->back()->with('error', 'Pesan tidak ditemukan.');
        }

        return view('dashboard-admin.menu.detail_kotak_masuk', compact('pesan'));
    }

    // Hapus pesan
    public function destroy($id)
    {
        $pesan = Pesan::find($id);

        if (!$pesan) {
            return redirect()->back()->with('error', 'Pesan tidak ditemukan.');
        }

        $pesan->delete();

        return redirect()->route('kotak-masuk.index')->with('success', 'Pesan berhasil dihapus.');
    }
}