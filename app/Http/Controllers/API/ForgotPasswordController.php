<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ForgotPasswordController extends Controller
{
    public function sendOtp(Request $request)
    {
        // Validasi email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $email = $request->input('email');
        $otp = rand(100000, 999999); // Generate OTP
        $otpExpiration = Carbon::now()->addMinutes(10);

        if ($this->sendOtpEmail($email, $otp)) {
            // Simpan OTP di session
            Session::put('otp', $otp);
            Session::put('email', $email);
            Session::put('otp_expiration', $otpExpiration);

            return response()->json(['message' => 'Kode OTP telah dikirim ke email Anda.'], 200);
        }

        return response()->json(['message' => 'Gagal mengirim OTP. Silakan coba lagi.'], 500);
    }

    private function sendOtpEmail($email, $otp)
    {
        $mail = new PHPMailer(true);

        try {
            // Konfigurasi SMTP
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', PHPMailer::ENCRYPTION_STARTTLS);
            $mail->Port = env('MAIL_PORT');

            // Pengaturan email
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Anda untuk Reset Password';
            $mail->Body = "<p>Kode OTP Anda: <strong>$otp</strong></p>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            Log::error('PHPMailer Error: ' . $mail->ErrorInfo);
            return false;
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $inputOtp = $request->input('otp');
        $sessionOtp = Session::get('otp');
        $otpExpiration = Session::get('otp_expiration');

        if ($sessionOtp && $inputOtp == $sessionOtp) {
            if (Carbon::now()->lte($otpExpiration)) {
                return response()->json(['message' => 'OTP berhasil diverifikasi. Silakan lanjutkan reset password.'], 200);
            } else {
                return response()->json(['message' => 'Kode OTP telah kedaluwarsa.'], 400);
            }
        }

        return response()->json(['message' => 'Kode OTP tidak valid.'], 400);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = Session::get('email');

        if (!$email) {
            return response()->json(['message' => 'Sesi telah berakhir. Silakan ulangi proses.'], 400);
        }

        $user = User::where('email', $email)->first();
        if ($user) {
            $user->password = Hash::make($request->input('password'));
            $user->save();

            // Hapus session OTP
            Session::forget(['otp', 'email', 'otp_expiration']);

            return response()->json(['message' => 'Password berhasil diubah.'], 200);
        }

        return response()->json(['message' => 'Terjadi kesalahan. Silakan coba lagi.'], 500);
    }
}
