<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifikasiAkunController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        $registerData = Session::get('register_data');

        if (!$registerData || $request->otp != $registerData['otp']) {
            return response()->json(['message' => 'Kode OTP salah atau telah kedaluwarsa.'], 400);
        }

        return response()->json(['message' => 'OTP berhasil diverifikasi. Silakan buat password.'], 200);
    }
}
