<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthSanctumMiddleware;
use App\Http\Controllers\Api\Auth\{
    CreatePasswordController,
    ChangePasswordController,
    VerifikasiAkunController,
    ForgotPasswordController,
    LogoutController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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

