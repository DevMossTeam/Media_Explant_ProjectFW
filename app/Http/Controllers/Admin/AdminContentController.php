<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author\Berita;
use App\Models\Author\Tag;
use App\Models\Karya\DesainGrafis;
use App\Models\Karya\Fotografi;
use App\Models\Karya\Pantun;
use App\Models\Karya\Puisi;
use App\Models\Karya\Syair;
use App\Models\Produk\Buletin;
use App\Models\Produk\Majalah;
use App\Models\User;

class AdminContentController extends Controller
{
    public function berita(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $beritas = Berita::with('user')->paginate($perPage);
        $tags = Tag::all();
        return view('dashboard-admin.menu.berita', compact('beritas', 'tags', 'perPage'));
    }

    public function _detail_berita($id)
    {
        $beritas = Berita::with(['user', 'tags'])->findOrFail($id);
        $tags = Tag::all();
        $users = User::all();
        return view('dashboard-admin.menu._detail_berita', compact('beritas', 'tags', 'users'));
    }

    public function delete_berita($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }

    // ======================= Majalah =======================
    public function majalah(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $majalah = Majalah::with('user')->paginate($perPage);
        $tags = Tag::all();
        return view('dashboard-admin.menu.majalah', compact('majalah', 'tags', 'perPage'));
    }

    public function detail_majalah($id)
    {
        $majalah = Majalah::with('user')->findOrFail($id);
        return view('dashboard-admin.menu.detail_majalah', compact('majalah'));
    }

    public function delete_majalah($id)
    {
        $majalah = Majalah::findOrFail($id);
        $majalah->delete();
        return redirect()->back()->with('success', 'Majalah berhasil dihapus.');
    }

    // ======================= Buletin =======================
    public function buletin(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $buletin = Buletin::with('user')->paginate($perPage);
        $tags = Tag::all();
        return view('dashboard-admin.menu.buletin', compact('buletin', 'tags', 'perPage'));
    }

    public function detail_buletin($id)
    {
        $buletin = Buletin::with('user')->findOrFail($id);
        return view('dashboard-admin.menu.detail_buletin', compact('buletin'));
    }

    public function delete_buletin($id)
    {
        $buletin = Buletin::findOrFail($id);
        $buletin->delete();
        return redirect()->back()->with('success', 'Buletin berhasil dihapus.');
    }

    // ======================= Desain Grafis =======================
    public function desainGrafis(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $desainGrafis = DesainGrafis::with('user')->paginate($perPage);
        return view('dashboard-admin.menu.desain_grafis', compact('desainGrafis', 'perPage'));
    }

    public function detail_desain_grafis($id)
    {
        $desainGrafis = DesainGrafis::with('user')->findOrFail($id);
        return view('dashboard-admin.menu.detail_desain_grafis', compact('desainGrafis'));
    }

    public function delete_desain_grafis($id)
    {
        $desainGrafis = DesainGrafis::findOrFail($id);
        $desainGrafis->delete();
        return redirect()->back()->with('success', 'Desain grafis berhasil dihapus.');
    }

    // ======================= Fotografi =======================
    public function fotografi(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $fotografi = Fotografi::with('user')->paginate($perPage);
        return view('dashboard-admin.menu.fotografi', compact('fotografi', 'perPage'));
    }

    public function detail_fotografi($id)
    {
        $fotografi = Fotografi::with('user')->findOrFail($id);
        return view('dashboard-admin.menu.detail_fotografi', compact('fotografi'));
    }

    public function delete_fotografi($id)
    {
        $fotografi = Fotografi::findOrFail($id);
        $fotografi->delete();
        return redirect()->back()->with('success', 'Fotografi berhasil dihapus.');
    }

    // ======================= Pantun =======================
    public function pantun(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $pantun = Pantun::with('user')->paginate($perPage);
        return view('dashboard-admin.menu.pantun', compact('pantun', 'perPage'));
    }

    public function detail_pantun($id)
    {
        $pantun = Pantun::with('user')->findOrFail($id);
        return view('dashboard-admin.menu.detail_pantun', compact('pantun'));
    }

    public function delete_pantun($id)
    {
        $pantun = Pantun::findOrFail($id);
        $pantun->delete();
        return redirect()->back()->with('success', 'Pantun berhasil dihapus.');
    }

    // ======================= Puisi =======================
    public function puisi(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $puisi = Puisi::with('user')->paginate($perPage);
        return view('dashboard-admin.menu.puisi', compact('puisi', 'perPage'));
    }

    public function detail_puisi($id)
    {
        $puisi = Puisi::with('user')->findOrFail($id);
        return view('dashboard-admin.menu.detail_puisi', compact('puisi'));
    }

    public function delete_puisi($id)
    {
        $puisi = Puisi::findOrFail($id);
        $puisi->delete();
        return redirect()->back()->with('success', 'Puisi berhasil dihapus.');
    }

    // ======================= Syair =======================
    public function syair(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $syair = Syair::with('user')->paginate($perPage);
        return view('dashboard-admin.menu.syair', compact('syair', 'perPage'));
    }

    public function detail_syair($id)
    {
        $syair = Syair::with('user')->findOrFail($id);
        return view('dashboard-admin.menu.detail_syair', compact('syair'));
    }

    public function delete_syair($id)
    {
        $syair = Syair::findOrFail($id);
        $syair->delete();
        return redirect()->back()->with('success', 'Syair berhasil dihapus.');
    }
}
