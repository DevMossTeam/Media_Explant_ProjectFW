<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('user-auth.forgot_password');
    }

    public function sendOtp(Request $request)
    {
        // Validasi input email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->input('email');
        $otp = rand(100000, 999999); // Generate OTP 6 digit

        // Kirim OTP ke email
        if ($this->sendOtpEmail($email, $otp)) {
            return back()->with('status', 'Kode OTP telah dikirim ke email Anda.');
        }

        return back()->withErrors(['email' => 'Gagal mengirim OTP. Silakan coba lagi.']);
    }

    private function sendOtpEmail($email, $otp)
    {
        $mail = new PHPMailer(true);

        try {
            // Konfigurasi SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Server SMTP Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'devmossteam@gmail.com'; // Email Gmail Anda
            $mail->Password = 'auarutsuzgpwtriy'; // App Password Gmail Anda
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Pengaturan email
            $mail->setFrom('devmossteam@gmail.com', 'Media Explant');
            $mail->addAddress($email); // Email penerima

            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Anda';
            $mail->Body = '<p>Kode OTP Anda adalah: <strong>' . $otp . '</strong></p><p>Kode ini berlaku selama 10 menit.</p>';

            // Kirim email
            $mail->send();
            return true;
        } catch (Exception $e) {
            // Log error jika terjadi kesalahan
            \Log::error('PHPMailer Error: ' . $mail->ErrorInfo);
            return false;
        }
    }
}
