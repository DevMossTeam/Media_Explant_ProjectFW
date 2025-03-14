<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
    /**
     * Register User (API)
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pengguna' => 'required|unique:user,nama_pengguna|max:60',
            'email' => 'required|email|max:100|unique:user,email',
            'nama_lengkap' => 'required|max:100',
            'password' => 'required|min:8|confirmed',
        ]);

        // Generate UID secara otomatis
        $uid = substr(Str::uuid()->toString(), 0, 28);

        // Buat user baru dengan role "Pembaca"
        $user = User::create([
            'uid' => $uid,
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'password' => Hash::make($request->password),
            'role' => 'Pembaca',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil didaftarkan!',
            'user' => [
                'uid' => $user->uid,
                'nama_pengguna' => $user->nama_pengguna,
                'email' => $user->email,
                'role' => $user->role
            ]
        ], 201);
    }

    /**
     * Get All Users (API)
     */
    public function getUsers()
    {
        $users = User::select('uid', 'nama_pengguna', 'email', 'profile_pic', 'role', 'nama_lengkap')->get();

        return response()->json($users);
    }

    /**
     * Get User by UID (API)
     */
    public function getUserByUid($uid)
    {
        $user = User::select('uid', 'nama_pengguna', 'email', 'profile_pic', 'role', 'nama_lengkap')
                    ->where('uid', $uid)
                    ->first();

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan.'], 404);
        }

        return response()->json($user);
    }
}
