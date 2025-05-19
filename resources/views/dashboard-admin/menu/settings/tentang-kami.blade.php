@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-1 py-1">
    <div class="flex items-center justify-between my-5">
        <h1 class="font-bold text-2xl">Settings</h1>
        <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="list-reset flex">
                <li><a href="#" class="">Home</a></li>
                <li><span class="mx-2">></span></li>
                <li class="text-gray-700">Setting</li>
            </ol>
        </nav>
    </div>

    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-12 gap-4">
            <!-- Sidebar -->
            <div class="col-span-3">
                <div class="bg-white rounded-lg shadow p-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.settings') }}"
                                class="flex items-center space-x-3 px-4 py-2 bg-blue-200 hover:bg-blue-100 border-l-4 border-transparent rounded-lg">
                                <i class="fa-solid fa-address-book text-blue-800"></i>
                                <span class="text-blue-800">Tentang Kami</span>
                            </a>
                        </li>
                        <li>
                            <a href="/dashboard-admin/user_profile"
                                class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-50 border-l-4 border-transparent rounded-lg">
                                <i class="fa-solid fa-user text-gray-400"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="/dashboard-admin/stuktur_ogranisasi"
                                class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-50 border-l-4 border-transparent rounded-lg">
                                <i class="fa-solid fa-briefcase text-gray-400"></i>
                                <span>Struktur Organisasi</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-span-9 bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold mb-6 text-gray-700">Edit Tentang Kami</h1>
                <p class="mt-2 text-sm text-gray-500">Update informasi tentang website</p>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mt-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.settings.update') }}" method="POST" class="mt-6 space-y-6">
                    @csrf

                    <!-- Email -->
                    <div class="flex items-center">
                        <label for="email" class="w-1/4 text-md font-semibold text-gray-600">Email</label>
                        <div class="relative w-full max-w-md">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </span>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $data->email ?? '') }}"
                                class="pl-10 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                placeholder="email@gmail.com">
                        </div>
                    </div>

                    <!-- Nomor HP -->
                    <div class="flex items-center">
                        <label for="nomorHp" class="w-1/4 text-md font-semibold text-gray-600">Nomor HP</label>
                        <div class="relative w-full max-w-md">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone-alt text-gray-400"></i>
                            </span>
                            <input type="text" name="nomorHp" id="nomorHp"
                                value="{{ old('nomorHp', $data->nomorHp ?? '') }}"
                                class="pl-10 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                placeholder="+62">
                        </div>
                    </div>

                    <!-- Tentang Kami -->
                    <div class="flex items-start">
                        <label for="tentangKami" class="w-1/4 text-md font-semibold text-gray-600 mt-2">Tentang Kami</label>
                        <textarea name="tentangKami" id="tentangKami" rows="4"
                            class="w-full max-w-md p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tulis informasi tentang kami...">{{ old('tentangKami', $data->tentangKami ?? '') }}</textarea>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h2 class="text-md font-semibold text-gray-600 mb-4">Social Media</h2>

                        @php
                            $socials = ['facebook', 'youtube', 'linkedin', 'instagram'];
                        @endphp

                        @foreach($socials as $social)
                            <div class="flex items-center mb-4">
                                <label class="w-1/4 capitalize text-gray-600">{{ ucfirst($social) }}</label>
                                <div class="relative w-full max-w-md">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fab fa-{{ $social }} text-gray-400"></i>
                                    </span>
                                    <input type="text" name="{{ $social }}"
                                        value="{{ old($social, $data->$social ?? '') }}"
                                        class="pl-10 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                        placeholder="{{ ucfirst($social) }} URL">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Kode Etik -->
                    <div class="flex items-start">
                        <label for="kodeEtik" class="w-1/4 text-md font-semibold text-gray-600 mt-2">Kode Etik</label>
                        <textarea name="kodeEtik" id="kodeEtik" rows="4"
                            class="w-full max-w-md p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Isi kode etik...">{{ old('kodeEtik', $data->kodeEtik ?? '') }}</textarea>
                    </div>

                    <!-- Explant Contributor -->
                    <div class="flex items-start">
                        <label for="explantContributor" class="w-1/4 text-md font-semibold text-gray-600 mt-2">Explant Contributor</label>
                        <textarea name="explantContributor" id="explantContributor" rows="4"
                            class="w-full max-w-md p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tuliskan kontributor...">{{ old('explantContributor', $data->explantContributor ?? '') }}</textarea>
                    </div>

                    <hr class="my-4">

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white text-md font-semibold py-2 px-4 rounded">
                            Update Tentang Kami
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
