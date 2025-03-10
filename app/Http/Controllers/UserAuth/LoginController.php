<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login untuk web.
     */
    public function showLoginForm()
    {
        return view('user-auth.login'); // Sesuai struktur `resources/views/user/`
    }

    /**
     * Proses login pengguna (untuk web dan API).
     */
    public function login(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'identifier' => 'required', // Bisa berupa nama_pengguna atau email
            'password' => 'required',
        ]);

        // Cari pengguna berdasarkan nama_pengguna atau email
        $user = User::where('nama_pengguna', $request->identifier)
                    ->orWhere('email', $request->identifier)
                    ->first();

        // Cek apakah pengguna ada dan password sesuai
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['message' => 'Nama pengguna atau password salah.']);
        }

        // Gunakan Auth::login untuk menyimpan pengguna di session
        Auth::login($user);

        // Set cookie untuk menyimpan UID pengguna
        Cookie::queue('user_uid', $user->id, 60 * 24 * 30); // 30 hari

        // Jika login dari API, buat token menggunakan Sanctum
        if ($request->wantsJson() || $request->is('api/*')) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
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

        // Jika dari web, arahkan berdasarkan role
        if ($user->role === 'Admin') {
            return redirect()->route('dashboard-admin')->with('success', 'Selamat datang, Admin!');
        } else {
            return redirect('/')->with('success', 'Login berhasil!');
        }
    }

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request)
    {
        // Hapus session login
        Auth::logout();

        // Hapus cookie saat pengguna logout
        Cookie::queue(Cookie::forget('user_uid'));

        // Jika logout dari API, hapus token pengguna
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Logout berhasil!'
            ]);
        }

        return redirect()->route('login');
    }
}
