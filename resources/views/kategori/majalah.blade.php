@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    </head>

    <div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- Bagian Produk Kami -->
            <section class="lg:col-span-2">
                <h2 class="text-3xl font-semibold">Produk Kami</h2>
                <p class="text-gray-600 mb-2 text-lg">Kumpulan Produk Terbaik</p>
                <div class="w-full h-[2px] bg-gray-300 mb-6"></div>

                <!-- Grid 2 Kolom, 7 Baris -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @for ($i = 0; $i < 14; $i++)
                        <div class="flex items-start space-x-4"> <!-- Gunakan items-start untuk naik ke atas -->
                            <!-- Gambar -->
                            <img src="https://via.placeholder.com/140x260" alt="Majalah"
                                class="w-40 h-52 object-cover rounded-lg shadow-md">

                            <!-- Konten -->
                            <div class="flex-1">
                                <!-- Label MAJALAH | Tanggal -->
                                <div class="flex items-start space-x-2 text-sm text-gray-700 mb-1">
                                    <span class="text-[#990505] font-semibold">MAJALAH |</span>
                                    <span>07 Des 2024</span>
                                </div>

                                <h3 class="text-lg font-semibold leading-tight">Majalah Himatplk Online</h3>
                                <a href="#" class="text-[#5773FF] font-medium text-sm">Lihat Majalah</a>
                                <p class="text-sm text-gray-500 font-medium mt-1">MEDIA EXPLANT</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </section>

            <!-- Bagian Terbaru -->
            <section class="lg:col-span-1 mt-4">
                <div class="flex flex-col mb-6">
                    <div class="flex items-center">
                        <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                        <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                            style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                            Terbaru
                        </h2>
                    </div>
                    <div class="w-full h-[2px] bg-gray-300"></div>
                </div>

                <!-- Grid 1 Kolom, 8 Baris -->
                <div class="grid grid-cols-1 gap-6">
                    @for ($i = 0; $i < 8; $i++)
                        <div class="flex items-start space-x-4"> <!-- Gunakan items-start untuk naik ke atas -->
                            <!-- Gambar -->
                            <img src="https://via.placeholder.com/100x160" alt="Buletin"
                                class="w-28 h-40 object-cover rounded-lg shadow-md">

                            <!-- Konten -->
                            <div class="flex-1">
                                <!-- Label MAJALAH | Tanggal -->
                                <div class="flex items-start space-x-2 text-sm text-gray-700 mb-1">
                                    <span class="text-[#990505] font-semibold">MAJALAH |</span>
                                    <span>07 Des 2024</span>
                                </div>

                                <h3 class="text-sm font-semibold leading-tight">Majalah Online Morpin</h3>
                                <a href="#" class="text-[#5773FF] text-xs font-medium">Lihat Majalah</a>
                                <p class="text-xs text-gray-500 font-medium mt-1">MEDIA EXPLANT</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </section>
        </div>
    </div>
@endsection
