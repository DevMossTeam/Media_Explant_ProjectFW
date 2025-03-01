<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SignInController;
use App\Http\Controllers\API\SignUpController;
use App\Http\Controllers\API\VerifikasiAkunController;

Route::post('/register', [SignUpController::class, 'register']);
Route::post('/verify-otp', [VerifikasiAkunController::class, 'verifyOtp']);
Route::post('/set-password', [SignUpController::class, 'storePassword']);
Route::post('/login', [SignInController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [SignInController::class, 'me']);
    Route::post('/logout', [SignInController::class, 'logout']);
});
