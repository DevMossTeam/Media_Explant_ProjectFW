@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="grid grid-cols-12 gap-4">
        <!-- Sidebar -->
        <div class="col-span-3">
            @include('dashboard-admin.components.sidebar')
        </div>
        <!-- Main Content -->
        <div class="col-span-9 bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-6 text-gray-700">Dashboard Admin</h1>

            <!-- Statistik Utama -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="text-4xl mr-4">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Pengguna Terdaftar</p>
                            <p class="text-xl font-bold">120</p>
                        </div>
                    </div>
                </div>
                <div class="bg-green-500 text-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="text-4xl mr-4">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Artikel Diterbitkan</p>
                            <p class="text-xl font-bold">45</p>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="text-4xl mr-4">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Kegiatan Terselenggara</p>
                            <p class="text-xl font-bold">8</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Sekunder -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-indigo-500 text-white p-6 rounded-lg shadow">
                    <p class="text-sm font-semibold">Komentar Baru</p>
                    <p class="text-xl font-bold mt-2">12</p>
                </div>
                <div class="bg-red-500 text-white p-6 rounded-lg shadow">
                    <p class="text-sm font-semibold">Laporan Masalah</p>
                    <p class="text-xl font-bold mt-2">3</p>
                </div>
                <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
                    <p class="text-sm font-semibold">Pengguna Aktif Hari Ini</p>
                    <p class="text-xl font-bold mt-2">25</p>
                </div>
                <div class="bg-gray-500 text-white p-6 rounded-lg shadow">
                    <p class="text-sm font-semibold">Draft Artikel</p>
                    <p class="text-xl font-bold mt-2">7</p>
                </div>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-600 mb-4">Aktivitas Terbaru</h2>
                <ul class="divide-y divide-gray-200 bg-gray-50 rounded-lg shadow p-4">
                    <li class="py-4">
                        <div class="flex justify-between">
                            <p class="text-gray-700">Admin mengunggah artikel baru: "Judul Artikel 1"</p>
                            <span class="text-gray-500 text-sm">2 jam yang lalu</span>
                        </div>
                    </li>
                    <li class="py-4">
                        <div class="flex justify-between">
                            <p class="text-gray-700">Pengguna "JohnDoe" mendaftar ke platform</p>
                            <span class="text-gray-500 text-sm">4 jam yang lalu</span>
                        </div>
                    </li>
                    <li class="py-4">
                        <div class="flex justify-between">
                            <p class="text-gray-700">Kegiatan baru ditambahkan: "Seminar Teknologi"</p>
                            <span class="text-gray-500 text-sm">1 hari yang lalu</span>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Daftar Artikel -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-600 mb-4">Daftar Artikel</h2>
                <div class="bg-gray-50 rounded-lg shadow p-4">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="py-2 px-4 border">#</th>
                                <th class="py-2 px-4 border">Judul Artikel</th>
                                <th class="py-2 px-4 border">Penulis</th>
                                <th class="py-2 px-4 border">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border">1</td>
                                <td class="py-2 px-4 border">Judul Artikel 1</td>
                                <td class="py-2 px-4 border">Admin</td>
                                <td class="py-2 px-4 border">02 Jan 2025</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">2</td>
                                <td class="py-2 px-4 border">Judul Artikel 2</td>
                                <td class="py-2 px-4 border">Editor</td>
                                <td class="py-2 px-4 border">01 Jan 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pengguna Baru -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-600 mb-4">Pengguna Baru</h2>
                <div class="bg-gray-50 rounded-lg shadow p-4">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="py-2 px-4 border">#</th>
                                <th class="py-2 px-4 border">Nama</th>
                                <th class="py-2 px-4 border">Email</th>
                                <th class="py-2 px-4 border">Tanggal Bergabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border">1</td>
                                <td class="py-2 px-4 border">John Doe</td>
                                <td class="py-2 px-4 border">john.doe@example.com</td>
                                <td class="py-2 px-4 border">03 Jan 2025</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">2</td>
                                <td class="py-2 px-4 border">Jane Smith</td>
                                <td class="py-2 px-4 border">jane.smith@example.com</td>
                                <td class="py-2 px-4 border">02 Jan 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
