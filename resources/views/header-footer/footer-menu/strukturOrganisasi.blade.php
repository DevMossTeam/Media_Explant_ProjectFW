@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-red-600 mb-6 text-center">Struktur Organisasi</h1>

    <div class="flex flex-col items-center space-y-6">
        <!-- Pimpinan Umum -->
        <div class="relative">
            <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md text-center w-60">
                <h2 class="text-lg font-bold">Pimpinan Umum</h2>
            </div>
            <div class="h-6 w-1 bg-gray-700 mx-auto"></div>
        </div>

        <!-- Biro Umum (Lebih ke kanan) -->
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

                <!-- Staf -->
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

                <!-- Staf -->
                <div class="bg-blue-200 text-black p-3 rounded-lg shadow-md text-center w-40 mt-3">
                    <h3 class="text-md font-semibold">Staf</h3>
                </div>

                <!-- Redaktur Pelaksana -->
                <div class="h-6 w-1 bg-gray-700"></div>
                <div class="bg-blue-300 text-black p-3 rounded-lg shadow-md text-center w-40 mt-3">
                    <h3 class="text-md font-semibold">Redaktur Pelaksana</h3>
                </div>
            </div>

            <!-- CO Litbang -->
            <div class="relative flex flex-col items-center">
                <div class="bg-blue-300 text-white p-4 rounded-lg shadow-md text-center w-52">
                    <h2 class="text-lg font-bold">CO. Penelitian dan Pengembangan</h2>
                </div>
                <div class="h-6 w-1 bg-gray-700"></div>

                <!-- Staf -->
                <div class="bg-blue-200 text-black p-3 rounded-lg shadow-md text-center w-40 mt-3">
                    <h3 class="text-md font-semibold">Staf</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
