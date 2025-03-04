<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\{
    CreatePasswordController,
    ChangePasswordController,
    VerifikasiAkunController,
    ForgotPasswordController,
    LogoutController
};
use App\Http\Middleware\AuthSanctumMiddleware;

// Group route untuk autentikasi
Route::prefix('auth')->group(function () {
    Route::post('/verify-otp', [VerifikasiAkunController::class, 'verifyOtp']);
    Route::post('/create-password', [CreatePasswordController::class, 'storePassword']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp']);
    Route::post('/verify-forgot-otp', [ForgotPasswordController::class, 'verifyOtp']);
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword']);
    Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware([AuthSanctumMiddleware::class])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout']);
});
