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
                <div class="w-full h-[2px] bg-gray-300"></div> <!-- Garis bawah -->

                <div class="grid grid-cols-1 gap-8 mt-4">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="relative rounded-lg overflow-hidden shadow-md">
                            <!-- Gambar lebih tinggi -->
                            <img src="https://via.placeholder.com/600x400" alt="Buletin" class="w-full h-96 object-cover">

                            <!-- Overlay Gradien Linear -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#990505] to-transparent opacity-90"></div>

                            <!-- Konten di dalam gambar -->
                            <div class="absolute bottom-0 left-0 p-4 text-white w-full">
                                <!-- Kategori dan Tanggal -->
                                <p class="text-sm font-medium flex items-center gap-2">
                                    <span>BULETIN</span> | <span>07 Des 2024</span>
                                </p>

                                <!-- Judul -->
                                <h2 class="text-lg font-semibold mt-1">Buletin Online M2B edisi 1</h2>

                                <!-- Deskripsi -->
                                <p class="text-sm mt-1 line-clamp-2">
                                    Kami kembali hadir dengan buletin yang menyajikan berbagai informasi menarik dan
                                    bermanfaat. Buletin ini dirancang untuk memberikan wawasan terbaru ...
                                </p>
                            </div>

                            <!-- Ikon PDF -->
                            <div class="absolute bottom-4 right-4">
                                <img src="https://img.icons8.com/ios-filled/50/ffffff/pdf.png" alt="PDF Icon"
                                    class="w-10 h-10">
                            </div>
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
                        <div>
                            <!-- Gambar dengan sudut rounded -->
                            <div class="relative">
                                <img src="https://via.placeholder.com/300x180" alt="Buletin"
                                    class="w-full h-40 object-cover rounded-lg">
                                <!-- Overlay Linear -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#990505] to-transparent opacity-80 rounded-lg">
                                </div>
                                <!-- Ikon PDF -->
                                <div class="absolute bottom-2 left-2">
                                    <i class="fa-solid fa-file-pdf text-white text-2xl"></i>
                                </div>
                            </div>

                            <!-- Judul -->
                            <h3 class="text-lg font-semibold mt-2">Buletin Morpin Edisi 107/2021</h3>

                            <!-- Link Download -->
                            <div class="flex items-center mt-1">
                                <i class="fa-solid fa-download text-[#5773FF] mr-2"></i>
                                <a href="#" class="text-[#5773FF] text-lg font-medium">Unduh Sekarang</a>
                            </div>

                            <!-- Penulis, Like, dan Share -->
                            <div class="flex items-center mt-2 text-gray-500 text-sm">
                                <span class="font-medium">MEDIA EXPLANT</span>
                                <div class="flex items-center ml-auto">
                                    <i class="fa-solid fa-thumbs-up text-[#ABABAB] text-lg"></i>
                                    <span class="ml-1">25</span>
                                    <!-- Ikon Share Baru -->
                                    <i class="fa-solid fa-share-nodes ml-4 text-[#ABABAB]"></i>
                                </div>
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
                <!-- Garis Bawah MENEMPEL dengan Label -->
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>
            <!-- Grid 4 kolom per baris, total 8 item -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @for ($i = 0; $i < 8; $i++)
                    <div>
                        <!-- Gambar dengan overlay -->
                        <div class="relative rounded-lg overflow-hidden shadow-md">
                            <img src="https://via.placeholder.com/300x180" alt="Buletin"
                                class="w-full h-52 object-cover rounded-lg">

                            <!-- Overlay Gradien -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#990505] to-transparent opacity-90"></div>

                            <!-- Ikon PDF di pojok kiri bawah -->
                            <div class="absolute bottom-2 left-2">
                                <img src="https://img.icons8.com/ios-filled/50/ffffff/pdf.png" alt="PDF Icon"
                                    class="w-8 h-8">
                            </div>
                        </div>

                        <!-- Kategori dan Tanggal -->
                        <p class="text-sm font-semibold flex items-center mt-2">
                            <span class="text-[#990505]">BULETIN</span>
                            <span class="mx-1 text-[#990505]">|</span>
                            <span class="text-[#ABABAB]">13 Feb 2025</span>
                        </p>

                        <!-- Judul -->
                        <h3 class="text-lg font-semibold mt-1">Buletin Morpin Edisi 107/2021</h3>

                        <!-- Deskripsi -->
                        <p class="text-sm text-gray-700 mt-1">
                            Kami kembali hadir menyajikan berbagai informasi menarik dan ...
                        </p>

                        <!-- Link Download -->
                        <div class="flex items-center mt-1">
                            <i class="fa-solid fa-download text-[#5773FF] mr-2"></i>
                            <a href="#" class="text-[#5773FF] text-lg font-medium">Unduh Sekarang</a>
                        </div>
                    </div>
                @endfor
            </div>
    </div>
    </section>
    </div>
@endsection
