<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class SettingController extends Controller
{
    public function umumSettings()
    {
        // Ambil UID pengguna dari cookie
        $userUid = Cookie::get('user_uid');

        // Default $user adalah null
        $user = null;

        // Ambil data pengguna jika UID tersedia
        if ($userUid) {
            $user = User::where('uid', $userUid)
                ->select('nama_pengguna', 'password', 'email', 'nama_lengkap')
                ->first();
        }

        // Debugging: Pastikan $user dikirim
        // dd($user);

        // Kirim $user ke view
        return view('settings.umum', ['user' => $user]);
    }
}
