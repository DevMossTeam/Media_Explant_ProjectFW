<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CreatePasswordController extends Controller
{
    public function showCreatePasswordForm()
    {
        return view('user-auth.create_password');
    }

    public function storePassword(Request $request)
    {
        $request->validate(['password' => 'required|min:6']);

        $registerData = Session::get('register_data');

        if (!$registerData) {
            return redirect()->route('register')->withErrors(['error' => 'Terjadi kesalahan. Silakan daftar ulang.']);
        }

        User::create([
            'uid' => $registerData['uid'],
            'nama_pengguna' => $registerData['nama_pengguna'],
            'email' => $registerData['email'],
            'nama_lengkap' => $registerData['nama_lengkap'],
            'password' => Hash::make($request->password),
            'role' => 'Pembaca',
        ]);

        Session::forget('register_data');

        return redirect('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
