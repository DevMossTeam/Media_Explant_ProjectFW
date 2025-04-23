@extends('layouts.setting-layout')

@section('title', 'Pengaturan Umum')

@section('setting-content')
    <h2 class="text-red-600 font-bold mb-6 text-lg">Profile Akun Anda</h2>

    <!-- Foto Profil -->
    <div class="flex items-center mb-6">
        <div
            class="relative w-24 h-24 rounded-full bg-yellow-400 flex items-center justify-center text-white text-4xl font-bold border-4 border-red-500">
            {{ strtoupper(substr($user->nama_pengguna ?? 'C', 0, 1)) }}
            <div class="absolute bottom-0 right-0 bg-red-500 rounded-full p-1">
                <i class="fas fa-camera text-white text-xs"></i>
            </div>
        </div>
        <p class="ml-4 text-sm text-gray-500">Foto ini akan muncul dalam profil anda, ayo pasang profile terbaikmu!</p>
    </div>

    <!-- Form Data Akun -->
    <div class="space-y-6">
        <div>
            <p class="text-red-600 font-semibold text-sm">Username</p>
            <div class="flex items-center justify-between border-b pb-1">
                <span>{{ $user->nama_pengguna ?? 'Tidak Tersedia' }}</span>
                <i class="fas fa-pen text-gray-500 cursor-pointer"></i>
            </div>
        </div>

        <div>
            <p class="text-red-600 font-semibold text-sm">Nama Lengkap</p>
            <div class="flex items-center justify-between border-b pb-1">
                <span>{{ $user->nama_lengkap ?? 'Tidak Tersedia' }}</span>
                <i class="fas fa-pen text-gray-500 cursor-pointer"></i>
            </div>
        </div>

        <div>
            <p class="text-red-600 font-semibold text-sm">Email Anda</p>
            <div class="flex items-center justify-between border-b pb-1">
                <span>{{ $user->email ?? 'Tidak Tersedia' }}</span>
                <i class="fas fa-pen text-gray-500 cursor-pointer"></i>
            </div>
        </div>

        <div>
            <p class="text-red-600 font-semibold text-sm">Password Akun</p>
            <div class="flex items-center justify-between border-b pb-1">
                <span>********</span>
                <i class="fas fa-pen text-gray-500 cursor-pointer"></i>
            </div>
        </div>
    </div>

    <!-- Simpan Perubahan -->
    <div class="mt-8">
        <button class="bg-red-500 text-white px-6 py-2 rounded shadow hover:bg-red-600">Simpan Perubahan</button>
        <p class="text-xs text-gray-500 mt-2">Mohon diperhatikan! perubahan yang dibuat tidak dapat dikembalikan</p>
    </div>
@endsection
