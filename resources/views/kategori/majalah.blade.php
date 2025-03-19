@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <!-- Bagian Produk Kami (Kiri, Full Width di Mobile, 2/3 di Desktop) -->
        <section class="lg:col-span-2">
            <h2 class="text-3xl font-semibold">Produk Kami</h2>
            <p class="text-gray-600 mb-2 text-lg">Kumpulan Produk Terbaik</p>
            <div class="w-full h-[2px] bg-gray-300 mb-6"></div> <!-- Garis bawah -->

            <!-- Daftar Majalah (1 Item Per Baris, Total 12) -->
            <div class="grid grid-cols-1 gap-6">
                @for ($i = 0; $i < 12; $i++)
                    <div class="flex items-center space-x-4">
                        <!-- Gambar (Lebih Lebar) -->
                        <img src="https://via.placeholder.com/180x240" alt="Majalah" class="w-56 h-32 object-cover rounded-lg shadow-md">

                        <!-- Konten di sebelah kanan gambar -->
                        <div class="flex-1">
                            <!-- Label MAJALAH | dan Tanggal -->
                            <div class="flex items-center space-x-2 text-sm text-gray-700 mb-1">
                                <span class="text-[#990505] font-semibold">MAJALAH |</span>
                                <span>07 Des 2024</span>
                            </div>

                            <h3 class="text-lg font-semibold leading-tight">Majalah Himatplk Online</h3>

                            <a href="#" class="text-[#5773FF] font-medium text-sm">Lihat Majalah</a>

                            <div class="flex items-center mt-2 text-gray-500 text-sm">
                                <span class="font-medium">MEDIA EXPLANT</span>
                                <div class="flex items-center ml-3 space-x-4">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-thumbs-up text-[#ABABAB]"></i>
                                        <span class="ml-1">107</span>
                                    </div>
                                    <i class="fa-solid fa-share-nodes text-[#ABABAB]"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </section>

        <!-- Bagian Terbaru (Kanan, Diturunkan lebih jauh agar sejajar) -->
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

            <!-- Grid 2 Kolom Per Baris, 4 Baris (Total 8 Item) -->
            <div class="grid grid-cols-2 gap-6">
                @for ($i = 0; $i < 8; $i++)
                    <div>
                        <!-- Gambar (Tanpa Warna Linear) -->
                        <img src="https://via.placeholder.com/300x180" alt="Buletin"
                            class="w-full h-40 object-cover rounded-lg shadow-md">

                        <h3 class="text-lg font-semibold mt-2">Majalah Online Morpin</h3>

                        <div class="flex items-center mt-1">
                            <i class="fa-solid fa-download text-[#5773FF] mr-2"></i>
                            <a href="#" class="text-[#5773FF] text-lg font-medium">Unduh Sekarang</a>
                        </div>

                        <div class="flex items-center mt-2 text-gray-500 text-sm">
                            <span class="font-medium">MEDIA EXPLANT</span>
                            <div class="flex items-center ml-3 space-x-4">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-thumbs-up text-[#ABABAB]"></i>
                                    <span class="ml-1">107</span>
                                </div>
                                <i class="fa-solid fa-share-nodes text-[#ABABAB]"></i>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </section>

    </div>

</div>

@endsection
