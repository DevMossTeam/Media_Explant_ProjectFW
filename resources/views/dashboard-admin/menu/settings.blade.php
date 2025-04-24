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
                g
            </ol>
        </nav>
    </div>
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-12 gap-4">
            <!-- Sidebar -->
            <div class="col-span-3">
                <div class="bg-white rounded-lg shadow p-4">
                    {{-- <h2 class="text-xl font-semibold text-gray-700 mb-4">Settings</h2> --}}
                    <ul class="space-y-2">
                        <!-- Aktif -->
                        <li>
                            <a href="{{ route('admin.settings')}}"
                                class="flex items-center space-x-3 px-4 py-2 bg-blue-200 hover:bg-blue-100 border-l-4 border-transparent rounded-lg">
                                <i class="fa-solid fa-address-book text-blue-800"></i>
                                <span class="text-blue-800">Tentang kami</span>
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
                                <span>Struktur Ogrnisasi</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Main Content -->
            <div class="col-span-9 bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold mb-6 text-gray-700">Edit Tentang Kami</h1>
    
                <!-- Aktivitas Terbaru -->
                <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Update Tentang
                    website</p>
                <hr>
                <div class="mt-2 space-y-6">
                    <!-- Email -->
                    <div class="flex items-center">
                        <label for="email" class="w-1/4 text-md font-semibold text-gray-600">Email</label>
                        <div class="relative w-full max-w-md">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </span>
                            <input type="email" id="email"
                                class="pl-10 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                placeholder="email@gmail.com">
                        </div>
                    </div>

                    <hr>

                    <!-- Nomor HP -->
                    <div class="flex items-center">
                        <label for="phone" class="w-1/4 text-md font-semibold text-gray-600">Nomor HP</label>
                        <div class="relative w-full max-w-md">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone-alt text-gray-400"></i>
                            </span>
                            <input type="number" id="phone"
                                class="pl-10 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                placeholder="+62">
                        </div>
                    </div>

                    <div class="flex items-center mt-2">
                        <label class="w-1/4"></label>
                        <div class="relative w-full max-w-md">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone-alt text-gray-400"></i>
                            </span>
                            <input type="number"
                                class="pl-10 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                placeholder="+62">
                        </div>
                    </div>

                    <hr class="max-w-md">

                    <!-- Tentang Kami -->
                    <div class="flex items-start">
                        <label for="message" class="w-1/4 text-md font-semibold text-gray-600 mt-2">Tentang Kami</label>
                        <textarea id="message" rows="4"
                            class="w-full max-w-md p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>
                    </div>

                    <hr>

                    <!-- Social -->
                    <div>
                        <h2 class="text-md font-semibold text-gray-600 mb-4">Social Media</h2>

                        <!-- Facebook -->
                        <div class="flex items-center mb-4">
                            <label class="w-1/4 text-gray-600">Facebook</label>
                            <div class="relative w-full max-w-md">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fab fa-facebook-f text-gray-400"></i>
                                </span>
                                <input type="text"
                                    class="pl-10 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                    placeholder="Facebook URL">
                            </div>
                        </div>

                        <!-- YouTube -->
                        <div class="flex items-center mb-4">
                            <label class="w-1/4 text-gray-600">YouTube</label>
                            <div class="relative w-full max-w-md">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fab fa-youtube text-gray-400"></i>
                                </span>
                                <input type="text"
                                    class="pl-10 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                    placeholder="YouTube URL">
                            </div>
                        </div>

                        <!-- LinkedIn -->
                        <div class="flex items-center mb-4">
                            <label class="w-1/4 text-gray-600">LinkedIn</label>
                            <div class="relative w-full max-w-md">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fab fa-linkedin-in text-gray-400"></i>
                                </span>
                                <input type="text"
                                    class="pl-10 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                    placeholder="LinkedIn URL">
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="flex items-center">
                            <label class="w-1/4 text-gray-600">Instagram</label>
                            <div class="relative w-full max-w-md">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fab fa-instagram text-gray-400"></i>
                                </span>
                                <input type="text"
                                    class="pl-10 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                    placeholder="Instagram URL">
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-3">
                <button class="bg-green-500 hover:bg-green-700 text-white text-md font-semibold py-2 px-4 rounded">
                    Update Tentang Kami
                </button>


            </div>
        </div>
    </div>
</div>
@endsection
