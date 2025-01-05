<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('user-auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|unique:user,nama_pengguna|max:60',
            'password' => 'required|min:6',
            'email' => 'required|email|max:100|unique:user,email',
            'nama_lengkap' => 'required|max:100',
        ]);

        // Membuat UID 28 karakter dari UUID
        $uid = substr(str_replace('-', '', Str::uuid()->toString()), 0, 28);

        // Membuat pengguna baru
        $user = User::create([
            'uid' => $uid,
            'nama_pengguna' => $request->nama_pengguna,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role' => 'Pembaca',
            'nama_lengkap' => $request->nama_lengkap,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
