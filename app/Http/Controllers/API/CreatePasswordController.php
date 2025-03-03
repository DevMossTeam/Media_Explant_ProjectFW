<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CreatePasswordController extends Controller
{
    public function storePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6'
        ]);

        $registerData = Session::get('register_data');

        if (!$registerData) {
            return response()->json(['message' => 'Terjadi kesalahan. Silakan daftar ulang.'], 400);
        }

        $user = User::create([
            'uid' => $registerData['uid'],
            'nama_pengguna' => $registerData['nama_pengguna'],
            'email' => $registerData['email'],
            'nama_lengkap' => $registerData['nama_lengkap'],
            'password' => Hash::make($request->password),
            'role' => 'Pembaca',
        ]);

        Session::forget('register_data');

        return response()->json([
            'message' => 'Akun berhasil dibuat. Silakan login.',
            'user' => $user
        ], 201);
    }
}
