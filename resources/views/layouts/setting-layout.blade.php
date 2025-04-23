{{-- resources/views/layouts/setting-layout.blade.php --}}
@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-60 bg-gray-100 p-4 flex flex-col gap-4 border-r">
            <a href="{{ route('settings.umum') }}"
                class="flex items-center gap-2 text-gray-600 cursor-pointer hover:text-blue-600 {{ request()->routeIs('settings.umum') ? 'text-blue-600 font-semibold' : '' }}">
                <i class="fas fa-user"></i>
                Akun
            </a>
            <a href="{{ route('settings.notifikasi') }}"
                class="flex items-center gap-2 text-gray-600 cursor-pointer hover:text-blue-600 {{ request()->routeIs('settings.notifikasi') ? 'text-blue-600 font-semibold' : '' }}">
                <i class="fas fa-bell"></i>
                Notifikasi
            </a>
            <a href="{{ route('settings.bantuan') }}"
                class="flex items-center gap-2 text-gray-600 cursor-pointer hover:text-blue-600 {{ request()->routeIs('settings.bantuan') ? 'text-blue-600 font-semibold' : '' }}">
                <i class="fas fa-question-circle"></i>
                Pusat Bantuan
            </a>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-y-auto">
            @yield('setting-content')
        </div>
    </div>
@endsection
