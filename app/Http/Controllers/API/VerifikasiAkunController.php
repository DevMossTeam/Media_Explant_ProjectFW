<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VerifikasiAkunController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric|digits:6',
        ]);

        $cachedOtp = Cache::get("otp_{$request->email}");

        if (!$cachedOtp || $request->otp != $cachedOtp) {
            return response()->json([
                'message' => 'Kode OTP salah atau telah kedaluwarsa.'
            ], 400);
        }

        // Hapus OTP setelah verifikasi
        Cache::forget("otp_{$request->email}");

        return response()->json([
            'message' => 'OTP berhasil diverifikasi.'
        ], 200);
    }
}
