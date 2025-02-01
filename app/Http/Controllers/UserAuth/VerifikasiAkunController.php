<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifikasiAkunController extends Controller
{
    public function showVerifikasiForm()
    {
        return view('user-auth.verif_akun');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        $registerData = Session::get('register_data');

        if (!$registerData || $request->otp != $registerData['otp']) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau telah kedaluwarsa.']);
        }

        return redirect()->route('buat-password')->with('success', 'OTP berhasil diverifikasi. Silakan buat password.');
    }
}
