@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    </head>

    <div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl">

        <!-- Bagian Produk Kami & Terbaru dalam Satu Baris -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Produk Kami (Kiri) -->
            <div>
                <h2 class="text-3xl font-semibold">Produk Kami</h2>
                <p class="text-gray-600 mb-2 text-lg">Kumpulan Produk Terbaik</p>
                <div class="w-full h-[2px] bg-gray-300"></div>

                <div class="grid grid-cols-1 gap-8 mt-4">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="relative rounded-lg overflow-hidden shadow-md">
                            <img src="https://via.placeholder.com/600x400" alt="Buletin" class="w-full h-96 object-cover">

                            <div class="absolute inset-0 bg-gradient-to-t from-[#990505] to-transparent opacity-90"></div>

                            <div class="absolute bottom-0 left-0 p-4 text-white w-full">
                                <p class="text-sm font-medium flex items-center gap-2">
                                    <span>BULETIN</span> | <span>07 Des 2024</span>
                                </p>

                                <h2 class="text-lg font-semibold mt-1">Buletin Online M2B edisi 1</h2>

                                <p class="text-sm mt-1 line-clamp-2">
                                    Kami kembali hadir dengan buletin yang menyajikan berbagai informasi menarik...
                                </p>
                            </div>

                            <div class="absolute bottom-4 right-4">
                                <img src="https://img.icons8.com/ios-filled/50/ffffff/pdf.png" alt="PDF Icon"
                                    class="w-10 h-10">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Terbaru (Kanan) -->
            <div class="mt-4">
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

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @for ($i = 0; $i < 12; $i++)
                        <div>
                            <div class="relative rounded-lg overflow-hidden shadow-md mb-2"> <!-- Tambahkan mb-2 -->
                                <img src="https://via.placeholder.com/300x220" alt="Buletin"
                                    class="w-full h-48 object-cover rounded-lg">
                            </div>

                            <p class="text-sm font-semibold flex items-center text-[#990505]">
                                <span>BULETIN</span> <span class="mx-1">|</span> <span class="text-[#ABABAB]">13 Feb
                                    2025</span>
                            </p>

                            <h3 class="text-lg font-semibold mt-1">Buletin Morpin Edisi 107/2021</h3>

                            <div class="flex items-center mt-1">
                                <i class="fa-solid fa-download text-[#5773FF] mr-2"></i>
                                <a href="#" class="text-[#5773FF] text-lg font-medium">Unduh Sekarang</a>
                            </div>
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
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>

            <!-- Grid 6 kolom per baris, total 12 item (2 baris) -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @for ($i = 0; $i < 12; $i++)
                    <div>
                        <div class="relative rounded-lg overflow-hidden shadow-md mb-2"> <!-- Tambahkan mb-2 -->
                            <img src="https://via.placeholder.com/300x180" alt="Buletin"
                                class="w-full h-52 object-cover rounded-lg">
                        </div>

                        <p class="text-sm font-semibold flex items-center">
                            <span class="text-[#990505]">BULETIN</span>
                            <span class="mx-1 text-[#990505]">|</span>
                            <span class="text-[#ABABAB]">13 Feb 2025</span>
                        </p>

                        <h3 class="text-lg font-semibold mt-1">Buletin Morpin Edisi 107/2021</h3>

                        <p class="text-sm text-gray-700 mt-1">
                            Kami kembali hadir menyajikan berbagai informasi menarik...
                        </p>

                        <div class="flex items-center mt-1">
                            <i class="fa-solid fa-download text-[#5773FF] mr-2"></i>
                            <a href="#" class="text-[#5773FF] text-lg font-medium">Unduh Sekarang</a>
                        </div>
                    </div>
                @endfor
            </div>
        </section>
    </div>
@endsection
