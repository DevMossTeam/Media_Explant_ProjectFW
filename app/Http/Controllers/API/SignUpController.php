<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_pengguna' => 'required|unique:users,nama_pengguna|max:60',
            'email' => 'required|email|max:100|unique:users,email',
            'nama_lengkap' => 'required|max:100',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Buat user baru
        $user = User::create([
            'uid' => substr(str_replace('-', '', Str::uuid()), 0, 28),
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'password' => Hash::make($request->password),
            'role' => 'Pembaca', // Default role
        ]);

        // Buat token untuk langsung login setelah registrasi
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil!',
            'user' => $user,
            'token' => $token,
        ]);
    }
}
