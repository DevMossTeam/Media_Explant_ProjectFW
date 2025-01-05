<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuth\LoginController;
use App\Http\Controllers\UserAuth\RegisterController;
use App\Http\Controllers\UserAuth\LogoutController;

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

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route untuk register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

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

Route::get('/authors/create', function () {
    return view('authors.create');
})->name('create-article');

Route::get('/authors/draft', function () {
    return view('authors.draft');
})->name('draft-article');

Route::get('/kategori/article-detail/{id}', function ($id) {
    return view('kategori.article-detail', compact('id'));
})->name('article.detail');
