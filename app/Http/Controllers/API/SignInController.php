<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'identifier' => 'required', // Bisa berupa email atau nama_pengguna
            'password' => 'required',
        ]);

        // Cari user berdasarkan email atau nama_pengguna
        $user = User::where('email', $request->identifier)
                    ->orWhere('nama_pengguna', $request->identifier)
                    ->first();

        // Cek apakah user ditemukan dan password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Nama pengguna atau password salah.'], 401);
        }

        // Hapus token lama jika ada
        $user->tokens()->delete();

        // Buat token baru
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil!',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout berhasil.']);
    }
}
