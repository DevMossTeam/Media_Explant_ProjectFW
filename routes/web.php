<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuth\LoginController;
use App\Http\Controllers\UserAuth\RegisterController;
use App\Http\Controllers\UserAuth\LogoutController;
use App\Http\Controllers\Author\BeritaController;
use App\Http\Controllers\Author\DraftController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\UserAuth\ForgotPasswordController;
use App\Http\Controllers\UserAuth\CreatePasswordController;
use App\Http\Controllers\UserAuth\VerifikasiAkunController;
use App\Http\Controllers\News\HomeNewsController;
use App\Http\Controllers\News\KampusNewsController;
use App\Http\Controllers\News\NasionalInternasionalNewsController;
use App\Http\Controllers\News\OpiniEsaiNewsController;
use App\Http\Controllers\News\KesenianSejarahNewsController;
use App\Http\Controllers\News\KesehatanAtletikNewsController;
use App\Http\Controllers\News\TeknologiNewsController;
use App\Http\Controllers\Author\ProdukController;
use App\Http\Controllers\Author\KaryaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
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

// Route untuk halaman Opini
Route::get('/kategori/opini', function () {
    return view('kategori.opini');
})->name('opini');

// Rute untuk halaman Buletin
Route::get('/produk/buletin', function () {
    return view('produk.buletin');
})->name('buletin');

// Rute untuk halaman Majalah
Route::get('/produk/majalah', function () {
    return view('produk.majalah');
})->name('majalah');

// Rute untuk halaman Puisi
Route::get('/karya/puisi', function () {
    return view('karya.puisi');
})->name('puisi');

// Rute untuk halaman Pantun
Route::get('/karya/pantun', function () {
    return view('karya.pantun');
})->name('pantun');

// Rute untuk halaman Syair
Route::get('/karya/syair', function () {
    return view('karya.syair');
})->name('syair');

// Rute untuk halaman Fotografi
Route::get('/karya/fotografi', function () {
    return view('karya.fotografi');
})->name('fotografi');

// Rute untuk halaman Desain Grafis
Route::get('/karya/desain-grafis', function () {
    return view('karya.desain-grafis');
})->name('desain-grafis');

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route untuk register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/verifikasi-akun', [VerifikasiAkunController::class, 'showVerifikasiForm'])->name('verifikasi-akun');
Route::post('/verifikasi-akun', [VerifikasiAkunController::class, 'verifyOtp'])->name('verify-otp');

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

// Route untuk membuat berita
Route::get('/authors/create', function () {
    return view('authors.create');
})->name('create-news');

// Route untuk draf berita
Route::get('/authors/draft', function () {
    return view('authors.draft');
})->name('draft-media');

Route::get('/authors/create-product', function () {
    return view('authors.create-product');
})->name('create-product');

Route::get('/authors/creation', function () {
    return view('authors.creation');
})->name('creation');

// Route untuk detail berita
Route::get('/kategori/news-detail/{id}', function ($id) {
    return view('kategori.news-detail', compact('id'));
})->name('news.detail');

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

// Route untuk menyimpan berita
Route::post('/author/berita/store', [BeritaController::class, 'store'])->name('author.berita.store');

// Route untuk menyimpan produk
Route::get('/create-product', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/create-product', [ProdukController::class, 'store'])->name('produk.store');

// Route untuk menyimpan karya
Route::post('/karya/store', [KaryaController::class, 'store'])->name('karya.store');

// Route untuk pengelolaan draft oleh author
Route::get('/author/drafts', [DraftController::class, 'index'])->name('authors.drafts');

Route::get('/profile', [ProfileController::class, 'mainProfile'])->name('profile');

Route::get('/settings/umum', [SettingController::class, 'umumSettings'])->name('settings.umum');

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.sendOtp');
Route::get('verify-otp', [ForgotPasswordController::class, 'showVerifyOtpForm'])->name('password.verifyOtpForm');
Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verifyOtp');
Route::get('ganti-password', [ForgotPasswordController::class, 'showChangePasswordForm'])->name('password.changePasswordForm');
Route::post('ganti-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.updatePassword');

Route::get('/kategori/kampus', [KampusNewsController::class, 'index'])->name('kampus');
Route::get('/kategori/kampus/read', [KampusNewsController::class, 'show'])->name('kampus.detail');
Route::get('/kategori/nasional-internasional', [NasionalInternasionalNewsController::class, 'index'])->name('nasional-internasional');
Route::get('/kategori/nasional-internasional/read', [NasionalInternasionalNewsController::class, 'show'])->name('nasional-internasional.detail');
Route::get('/kategori/opini-esai', [OpiniEsaiNewsController::class, 'index'])->name('opini-esai');
Route::get('/kategori/opini-esai/read', [OpiniEsaiNewsController::class, 'show'])->name('opini-esai.detail');
Route::get('/kategori/kesenian-sejarah', [KesenianSejarahNewsController::class, 'index'])->name('kesenian-sejarah');
Route::get('/kategori/kesenian-sejarah/read', [KesenianSejarahNewsController::class, 'show'])->name('kesenian-sejarah.detail');
Route::get('/kategori/kesehatan-atletik', [KesehatanAtletikNewsController::class, 'index'])->name('kesehatan-atletik');
Route::get('/kategori/kesehatan-atletik/read', [KesehatanAtletikNewsController::class, 'show'])->name('kesehatan-atletik.detail');
Route::get('/kategori/teknologi', [TeknologiNewsController::class, 'index'])->name('teknologi');
Route::get('/kategori/teknologi/read', [TeknologiNewsController::class, 'show'])->name('teknologi.detail');

Route::get('/', [HomeNewsController::class, 'index'])->name('home');

// Rute untuk kategori berita
Route::get('/kategori/{category}', [HomeNewsController::class, 'index'])->name('category');
Route::get('/kategori/{category}/read', [HomeNewsController::class, 'show'])->name('kategori.detail');

Route::view('/tentang-kami', 'header-footer.footer-menu.tentangKami');
Route::view('/explant-contributor', 'header-footer.footer-menu.explantContributor');
Route::view('/kode-etik', 'header-footer.footer-menu.kode-etik');
Route::view('/struktur-organisasi', 'header-footer.footer-menu.strukturOrganisasi');
Route::view('/pusat-bantuan', 'header-footer.footer-menu.pusatBantuan');

Route::post('/password/resend-otp', [ForgotPasswordController::class, 'resendOtp'])->name('password.resendOtp');
Route::post('/verifikasi-akun/resend-otp', [RegisterController::class, 'resendOtp'])->name('verifikasi-akun.resendOtp');
