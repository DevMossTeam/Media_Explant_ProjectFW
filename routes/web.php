<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuth\LoginController;
use App\Http\Controllers\UserAuth\RegisterController;
use App\Http\Controllers\UserAuth\LogoutController;
use App\Http\Controllers\Author\ArtikelController;
use App\Http\Controllers\Author\DraftController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\UserAuth\ForgotPasswordController;
use App\Http\Controllers\UserAuth\CreatePasswordController;
use App\Http\Controllers\UserAuth\VerifikasiAkunController;
use App\Http\Controllers\Article\OpiniArticleController;
use App\Http\Controllers\Article\DiskusiArticleController;
use App\Http\Controllers\Article\WawancaraArticleController;
use App\Http\Controllers\Article\RisetArticleController;
use App\Http\Controllers\Article\SiaranPersArticleController;
use App\Http\Controllers\Article\AgendaArticleController;
use App\Http\Controllers\Article\SastraArticleController;
use App\Http\Controllers\Article\HomeArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk halaman utama (Beranda)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk halaman Siaran Pers
Route::get('/kategori/siaran-pers', function () {
    return view('kategori.siaranPers');
})->name('siaran-pers');

// Route untuk halaman Riset
Route::get('/kategori/riset', function () {
    return view('kategori.riset');
})->name('riset');

// Route untuk halaman Wawancara
Route::get('/kategori/wawancara', function () {
    return view('kategori.wawancara');
})->name('wawancara');

// Route untuk halaman Diskusi
Route::get('/kategori/diskusi', function () {
    return view('kategori.diskusi');
})->name('diskusi');

// Route untuk halaman Agenda
Route::get('/kategori/agenda', function () {
    return view('kategori.agenda');
})->name('agenda');

// Route untuk halaman Sastra
Route::get('/kategori/sastra', function () {
    return view('kategori.sastra');
})->name('sastra');

// Route untuk halaman Opini
Route::get('/kategori/opini', function () {
    return view('kategori.opini');
})->name('opini');

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route untuk register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/verifikasi-akun', [VerifikasiAkunController::class, 'showVerifikasiForm'])->name('verifikasi-akun');
Route::post('/verifikasi-akun', [VerifikasiAkunController::class, 'verifyOtp'])->name('verify-otp'); // Tambahkan ini

Route::get('/buat-password', [CreatePasswordController::class, 'showCreatePasswordForm'])->name('buat-password');
Route::post('/buat-password', [CreatePasswordController::class, 'storePassword']);
Route::post('/store-password', [CreatePasswordController::class, 'storePassword'])->name('store-password');

// Route untuk logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route untuk pengaturan profil
Route::get('/settings', function () {
    return view('settings.umum'); // Pastikan file 'umum.blade.php' ada di folder 'settings'
})->name('settings');

// Route fallback jika halaman tidak ditemukan
Route::fallback(function () {
    return view('404'); // Pastikan Anda membuat file view '404.blade.php'
});

// Route untuk membuat artikel
Route::get('/authors/create', function () {
    return view('authors.create');
})->name('create-article');

// Route untuk draf artikel
Route::get('/authors/draft', function () {
    return view('authors.draft');
})->name('draft-article');

// Route untuk detail artikel
Route::get('/kategori/article-detail/{id}', function ($id) {
    return view('kategori.article-detail', compact('id'));
})->name('article.detail');

// Route untuk dashboard Admin
Route::get('/dashboard-admin', function () {
    return view('dashboard-admin.index'); // View untuk dashboard Admin
})->name('dashboard-admin');

Route::prefix('dashboard-admin')->group(function () {
    Route::get('/', function () {
        return view('dashboard-admin.index');
    })->name('dashboard-admin');

    Route::get('/articles', function () {
        return view('dashboard-admin.articles');
    })->name('dashboard-admin.articles');

    Route::get('/members', function () {
        return view('dashboard-admin.members');
    })->name('dashboard-admin.members');

    Route::get('/events', function () {
        return view('dashboard-admin.events');
    })->name('dashboard-admin.events');
});

// Route untuk menyimpan artikel
Route::post('/author/artikel/store', [ArtikelController::class, 'store'])->name('author.artikel.store');

// Route untuk pengelolaan draft oleh author
Route::prefix('authors')->middleware('auth')->group(function () {
    Route::get('drafts', [DraftController::class, 'index'])->name('author.draft.index');
    Route::delete('drafts/{id}', [DraftController::class, 'destroy'])->name('author.draft.destroy');
});

Route::get('/profile', [ProfileController::class, 'mainProfile'])->name('profile');

Route::get('/settings/umum', [SettingController::class, 'umumSettings'])->name('settings.umum');

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.sendOtp');
Route::get('verify-otp', [ForgotPasswordController::class, 'showVerifyOtpForm'])->name('password.verifyOtpForm');
Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verifyOtp');
Route::get('change-password', [ForgotPasswordController::class, 'showChangePasswordForm'])->name('password.changePasswordForm');
Route::post('change-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.updatePassword');

Route::get('/kategori/opini', [OpiniArticleController::class, 'index'])->name('opini');
Route::get('/kategori/opini/read', [OpiniArticleController::class, 'show'])->name('opini.detail');
Route::get('/kategori/diskusi', [DiskusiArticleController::class, 'index'])->name('diskusi');
Route::get('/kategori/diskusi/read', [DiskusiArticleController::class, 'show'])->name('diskusi.detail');
Route::get('/kategori/wawancara', [WawancaraArticleController::class, 'index'])->name('wawancara');
Route::get('/kategori/wawancara/read', [WawancaraArticleController::class, 'show'])->name('wawancara.detail');
Route::get('/kategori/riset', [RisetArticleController::class, 'index'])->name('riset');
Route::get('/kategori/riset/read', [RisetArticleController::class, 'show'])->name('riset.detail');
Route::get('/kategori/siaran-pers', [SiaranPersArticleController::class, 'index'])->name('siaran-pers');
Route::get('/kategori/siaran-pers/read', [SiaranPersArticleController::class, 'show'])->name('agenda.detail');
Route::get('/kategori/agenda', [AgendaArticleController::class, 'index'])->name('agenda');
Route::get('/kategori/agenda/read', [AgendaArticleController::class, 'show'])->name('agenda.detail');
Route::get('/kategori/sastra', [SastraArticleController::class, 'index'])->name('sastra');
Route::get('/kategori/sastra/read', [SastraArticleController::class, 'show'])->name('sastra.detail');
Route::get('/', [HomeArticleController::class, 'index'])->name('home');
