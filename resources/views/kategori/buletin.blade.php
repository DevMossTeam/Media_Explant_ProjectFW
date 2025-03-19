@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl">

    <!-- Bagian Produk Kami & Terbaru dalam Satu Baris -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Produk Kami (Kiri) -->
        <div>
            <h2 class="text-3xl font-semibold">Produk Kami</h2>
            <p class="text-gray-600 mb-6 text-lg">Kumpulan Produk Terbaik</p>
            <div class="grid grid-cols-1 gap-8">
                @for ($i = 0; $i < 3; $i++)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <img src="https://via.placeholder.com/600x300" alt="Buletin" class="w-full rounded-md">
                    <h2 class="text-2xl font-semibold mt-4">DIAWAL TAHUN 2023 SISWA MTSN 2 BOGOR</h2>
                    <p class="text-gray-600 text-lg">Buletin Online M2B edisi 1</p>
                    <button class="bg-[#9A0605] text-white px-6 py-3 mt-4 rounded-lg text-lg">Unduh</button>
                </div>
                @endfor
            </div>
        </div>

        <!-- Terbaru (Kanan) -->
        <div>
            <div class="flex flex-col mb-6">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                        style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Terbaru
                    </h2>
                </div>
                <!-- Garis Bawah MENEMPEL dengan Label -->
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @for ($i = 0; $i < 12; $i++)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <img src="https://via.placeholder.com/150" alt="Buletin" class="w-full rounded-md">
                    <h3 class="text-lg font-semibold mt-2">Buletin Morpin Edisi 10/2021</h3>
                    <a href="#" class="text-blue-500 text-lg font-medium">Unduh Sekarang</a>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Rekomendasi Hari Ini -->
    <section class="mt-12">
        <div class="flex flex-col mb-6">
            <div class="flex items-center">
                <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                    style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                    Rekomendasi Hari Ini
                </h2>
            </div>
            <!-- Garis Bawah MENEMPEL dengan Label -->
            <div class="w-full h-[2px] bg-gray-300"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @for ($i = 0; $i < 8; $i++)
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="https://via.placeholder.com/150" alt="Buletin" class="w-full rounded-md">
                <h3 class="text-lg font-semibold mt-2">Mahasiswa Angkatan 2020</h3>
                <a href="#" class="text-blue-500 text-lg font-medium">Unduh Sekarang</a>
            </div>
            @endfor
        </div>
    </section>
</div>
@endsection
