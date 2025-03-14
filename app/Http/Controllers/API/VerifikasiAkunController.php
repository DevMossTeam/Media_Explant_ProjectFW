<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class VerifikasiAkunController extends Controller
{
    public function showVerifikasiForm()
    {
        return view('user-auth.verif_akun');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        // Ambil data dari session
        $registerData = Session::get('register_data');

        // Debugging
        Log::info('Data di Session Saat Verifikasi:', $registerData ?? []);
        Log::info('OTP Input:', ['otp' => $request->otp]);

        // Validasi OTP
        if (!$registerData || strval($request->otp) !== strval($registerData['otp'])) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau telah kedaluwarsa.']);
        }

        return redirect()->route('buat-password')->with('success', 'OTP berhasil diverifikasi. Silakan buat password.');
    }
}
