<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class SignUpController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|unique:users|max:60',
            'email' => 'required|email|max:100|unique:users',
            'nama_lengkap' => 'required|max:100',
        ]);

        $uid = Str::uuid();
        $otp = rand(100000, 999999);

        // Simpan OTP ke cache (berlaku selama 10 menit)
        Cache::put("otp_{$request->email}", $otp, now()->addMinutes(10));

        // Kirim OTP ke email
        Mail::raw("Kode OTP Anda: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Verifikasi OTP');
        });

        return response()->json([
            'message' => 'Kode OTP telah dikirim ke email Anda.',
            'uid' => $uid
        ], 200);
    }

    public function storePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat akun baru
        $user = User::create([
            'uid' => Str::uuid(),
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'password' => Hash::make($request->password),
            'role' => 'Pembaca',
        ]);

        return response()->json([
            'message' => 'Akun berhasil dibuat, silakan login.',
            'user' => $user
        ], 201);
    }
}
