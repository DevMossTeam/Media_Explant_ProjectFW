<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TentangKami;

class TentangKamiController extends Controller
{
    public function index()
    {
        $data = TentangKami::first();
        return view('dashboard-admin.menu.settings.tentang-kami', compact('data'));
    }
    // resources/views/dashboard-admin/menu/settings/tentang-kami.blade.php
    public function update(Request $request)
    {
        $data = TentangKami::first();

        $request->validate([
            'email' => 'nullable|email',
            'nomorHp' => 'nullable|string',
            'tentangKami' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'youtube' => 'nullable|string',
            'kodeEtik' => 'nullable|string',
            'explantContributor' => 'nullable|string',
        ]);

        $data->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
