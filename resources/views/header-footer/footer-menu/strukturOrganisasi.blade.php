@extends('layouts.app')

@section('content')
    <!-- Header Merah Full Width -->
    <div class="bg-[#C12122] text-white text-center py-3 w-full">
        <h1 class="text-2xl font-semibold">Struktur Organisasi</h1>
    </div>

    <!-- Konten dengan padding atas dan bawah -->
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <!-- Penjelasan Singkat -->
        <section class="mb-8 max-w-3xl mx-auto text-justify">
            <h2 class="italic text-gray-800 mb-2">Penjelasan Singkat</h2>
            <p class="border-b border-gray-700 mb-4"></p>
            <p class="text-gray-700 leading-relaxed mt-2">
                Sebagai sebuah ruang pers mahasiswa yang bergerak dalam kerja kolektif dan kreatif, MediaExplant memiliki
                struktur organisasi yang disusun untuk mendukung jalannya produksi konten secara dinamis dan terorganisir.
                Setiap posisi dalam struktur ini diisi oleh individu yang memiliki tanggung jawab sesuai dengan bidangnya, namun
                tetap bekerja dalam semangat kolaboratif dan saling menguatkan.
            </p>
            <p class="text-gray-700 leading-relaxed mt-2">
                Struktur ini mencerminkan komitmen MediaExplant untuk menjaga kualitas, keberagaman, serta keberlanjutan gerakan
                literasi dan jurnalisme kampus.
            </p>
            <h2 class="italic text-gray-800 mt-6 mb-2">Susunan Keorganisasian UKPM EXPLANT</h2>
            <p class="border-b border-gray-700 mb-4"></p>
        </section>

        <!-- Struktur Organisasi Visual -->
        <div class="flex flex-col items-center space-y-6">
            <!-- Pimpinan Umum -->
            <div class="relative">
                <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md text-center w-60">
                    <h2 class="text-lg font-bold">Pimpinan Umum</h2>
                </div>
                <div class="h-6 w-1 bg-gray-700 mx-auto"></div>
            </div>

            <!-- Biro Umum -->
            <div class="relative flex justify-center w-full ml-96">
                <div class="bg-blue-400 text-white p-4 rounded-lg shadow-md text-center w-60">
                    <h2 class="text-lg font-bold">Biro Umum</h2>
                </div>
            </div>

            <!-- Level Tengah -->
            <div class="flex items-start justify-center space-x-12 relative mt-8">
                <div class="absolute top-4 left-1/4 w-1/2 h-1 bg-gray-700"></div>

                <!-- CO Jaringan Kerja -->
                <div class="relative flex flex-col items-center">
                    <div class="bg-blue-300 text-white p-4 rounded-lg shadow-md text-center w-52">
                        <h2 class="text-lg font-bold">CO. Jaringan Kerja</h2>
                    </div>
                    <div class="h-6 w-1 bg-gray-700"></div>
                    <div class="bg-blue-200 text-black p-3 rounded-lg shadow-md text-center w-40 mt-3">
                        <h3 class="text-md font-semibold">Staf</h3>
                    </div>
                </div>

                <!-- Pemimpin Redaksi -->
                <div class="relative flex flex-col items-center">
                    <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md text-center w-52">
                        <h2 class="text-lg font-bold">Pemimpin Redaksi</h2>
                    </div>
                    <div class="h-6 w-1 bg-gray-700"></div>
                    <div class="bg-blue-200 text-black p-3 rounded-lg shadow-md text-center w-40 mt-3">
                        <h3 class="text-md font-semibold">Staf</h3>
                    </div>
                    <div class="h-6 w-1 bg-gray-700"></div>
                    <div class="bg-blue-300 text-black p-3 rounded-lg shadow-md text-center w-40 mt-3">
                        <h3 class="text-md font-semibold">Redaktur Pelaksana</h3>
                    </div>
                </div>

                <!-- CO Litbang -->
                <div class="relative flex flex-col items-center">
                    <div class="bg-blue-300 text-white p-4 rounded-lg shadow-md text-center w-52">
                        <h2 class="text-lg font-bold">CO. Penelitian & Pengembangan</h2>
                    </div>
                    <div class="h-6 w-1 bg-gray-700"></div>
                    <div class="bg-blue-200 text-black p-3 rounded-lg shadow-md text-center w-40 mt-3">
                        <h3 class="text-md font-semibold">Staf</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
