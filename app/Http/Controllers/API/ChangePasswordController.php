<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Ambil email dari session
        $email = Session::get('otp_email');
        if (!$email) {
            return response()->json(['message' => 'Sesi telah berakhir. Silakan coba lagi.'], 400);
        }

        // Cari pengguna berdasarkan email
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan.'], 404);
        }

        // Update password
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Hapus session OTP
        Session::forget(['otp', 'otp_email', 'otp_expiration']);

        return response()->json(['message' => 'Password berhasil diubah. Silakan login.'], 200);
    }
}
