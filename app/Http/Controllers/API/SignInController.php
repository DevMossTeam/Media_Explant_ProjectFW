<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    /**
     * API Login (Mobile)
     */
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('nama_pengguna', $request->identifier)
                    ->orWhere('email', $request->identifier)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Nama pengguna atau password salah.'], 401);
        }

        // Buat token untuk API
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil!',
            'user' => [
                'uid' => $user->uid,
                'nama_pengguna' => $user->nama_pengguna,
                'email' => $user->email,
                'role' => $user->role
            ],
            'token' => $token
        ]);
    }

    /**
     * API Logout (Mobile)
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil!'
        ]);
    }
}
