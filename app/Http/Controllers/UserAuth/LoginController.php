<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login untuk web.
     */
    public function showLoginForm()
    {
        return view('user-auth.login');
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
            return response()->json([
                'message' => 'Nama pengguna atau password salah.'
            ], 401);
        }

        // Set cookie untuk menyimpan UID pengguna (hanya untuk web)
        Cookie::queue('user_uid', $user->uid, 60 * 24 * 30); // 30 hari

        // Set data pengguna ke session untuk akses di view (hanya untuk web)
        session(['user' => $user]);

        // Cek apakah request dari API atau Web
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Login berhasil!',
                'user' => [
                    'uid' => $user->uid,
                    'nama_pengguna' => $user->nama_pengguna,
                    'email' => $user->email,
                    'role' => $user->role
                ],
                'token' => '1|xyz123abcTokenSanctum' // Gantilah dengan token autentikasi yang sesuai
            ]);
        }

        // Jika dari web, arahkan berdasarkan role
        if ($user->role === 'Admin') {
            return redirect()->route('dashboard-admin')->with('success', 'Selamat datang, Admin!');
        } elseif (in_array($user->role, ['Penulis', 'Pembaca'])) {
            return redirect('/')->with('success', 'Login berhasil!');
        } else {
            return back()->withErrors(['message' => 'Role pengguna tidak dikenali.']);
        }
    }

    /**
     * Proses logout pengguna (untuk web dan API).
     */
    public function logout(Request $request)
    {
        // Hapus cookie saat pengguna logout
        Cookie::queue(Cookie::forget('user_uid'));

        // Hapus session pengguna
        session()->forget('user');

        // Jika logout dari API
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Logout berhasil!'
            ]);
        }

        // Jika logout dari web
        return redirect()->route('login');
    }
}
