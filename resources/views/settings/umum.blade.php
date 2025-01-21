@extends('layouts.app')

@section('title', 'Pengaturan Umum')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header Pengaturan -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 text-center">
            <h1 class="text-3xl font-bold mb-2">
                {{ isset($user) && $user ? $user->nama_pengguna : 'Nama Pengguna Tidak Tersedia' }}
            </h1>
            <p class="text-lg">
                {{ isset($user) && $user ? $user->email : 'Email Tidak Tersedia' }}
            </p>
        </div>

        <!-- Konten Pengaturan -->
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Nama Pengguna -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Nama Pengguna</h2>
                    <p class="text-gray-800 text-base">
                        {{ isset($user) && $user ? $user->nama_pengguna : 'Tidak Tersedia' }}
                    </p>
                </div>

                <!-- Email -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Email</h2>
                    <p class="text-gray-800 text-base">
                        {{ isset($user) && $user ? $user->email : 'Tidak Tersedia' }}
                    </p>
                </div>

                <!-- Password -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Password</h2>
                    <p class="text-gray-800 text-base">
                        {{ isset($user) && $user ? '********' : 'Tidak Tersedia' }}
                    </p>
                    @if(isset($user) && $user)
                        <a href="#" class="text-blue-500 text-sm">Ubah Password</a>
                    @endif
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-6 flex justify-center gap-4">
                @if(isset($user) && $user)
                    <a href="{{ route('settings.umum') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                        Edit Pengaturan
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
