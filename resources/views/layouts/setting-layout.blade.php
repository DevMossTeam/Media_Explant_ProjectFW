@extends('layouts.app')

@section('title', 'Pengaturan')

@include('settings.settingModal')

@section('content')
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-60 bg-gray-100 p-4 flex flex-col gap-4 border-r">
        <a href="javascript:void(0)" onclick="openSettingsModal('umum')"
            class="flex items-center gap-2 text-gray-600 hover:text-blue-600">
            <i class="fas fa-user"></i> Akun
        </a>
        <a href="javascript:void(0)" onclick="openSettingsModal('notifikasi')"
            class="flex items-center gap-2 text-gray-600 hover:text-blue-600">
            <i class="fas fa-bell"></i> Notifikasi
        </a>
        <a href="javascript:void(0)" onclick="openSettingsModal('bantuan')"
            class="flex items-center gap-2 text-gray-600 hover:text-blue-600">
            <i class="fas fa-question-circle"></i> Pusat Bantuan
        </a>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 overflow-y-auto">
        @yield('setting-content')
    </div>
</div>
@endsection
