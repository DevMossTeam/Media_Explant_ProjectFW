@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Form Penulisan Berita -->
            <div class="flex-1 bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 19c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l4-4m-4 0l-4 4"></path>
                    </svg>
                    Karya Publikasi
                </h1>

                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-medium">Judul</label>
                    <input type="text" id="judul" name="judul"
                        class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300"
                        placeholder="Masukkan judul berita...">
                </div>

                <div class="mb-4">
                    <label for="konten" class="block text-gray-700 font-medium">Konten berita</label>
                    <textarea id="konten" name="konten" rows="6"
                        class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300"
                        placeholder="Tulis konten berita di sini..."></textarea>
                </div>
            </div>

            <!-- Pengaturan Publikasi -->
            <div class="w-full lg:w-1/3 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-9-9 9 9 0 019 9z"></path>
                    </svg>
                    Pengaturan Publikasi
                </h2>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-gray-700 font-medium">Kategori</label>
                    <select id="kategori" name="kategori"
                        class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300">
                        <option value="siaran_pers">Siaran Pers</option>
                        <option value="politik">Politik</option>
                        <option value="olahraga">Olahraga</option>
                        <option value="hiburan">Hiburan</option>
                    </select>
                </div>

                <!-- Tambahkan Tag -->
                <div class="mb-4">
                    <label for="tags" class="block text-gray-700 font-medium">Tambahkan Tag</label>
                    <input type="text" id="tags" name="tags"
                        class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300"
                        placeholder="Ketik dan tekan ',' untuk menambahkan tag">
                </div>

                <!-- Visibilitas -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Visibilitas</label>
                    <div class="flex items-center gap-4 mt-1">
                        <label class="inline-flex items-center">
                            <input type="radio" name="visibility" value="public" class="text-blue-600">
                            <span class="ml-2 text-gray-600">Public</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="visibility" value="private" class="text-blue-600">
                            <span class="ml-2 text-gray-600">Private</span>
                        </label>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex items-center justify-between">
                    <button type="button"
                        class="bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition">
                        Pratinjau
                    </button>
                    <button type="submit"
                        class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition">
                        + Publikasikan
                    </button>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
