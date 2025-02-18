@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Buat Karya</h1>
            <p class="text-gray-600 text-sm mb-4 text-center">Tambahkan karya baru untuk dipublikasikan.</p>

            <!-- Form Pembuatan Karya -->
            <form action="#" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-medium">Judul Karya</label>
                    <input type="text" id="judul" name="judul"
                        class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-red-300">
                </div>

                <div class="mb-4">
                    <label for="kategori" class="block text-gray-700 font-medium">Kategori Karya</label>
                    <select id="kategori" name="kategori"
                        class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-red-300">
                        <option value="sastra">Sastra</option>
                        <option value="karikatur">Karikatur</option>
                        <option value="desain">Desain Grafis</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-medium">Deskripsi Karya</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-red-300"></textarea>
                </div>

                <div class="mb-4">
                    <label for="gambar" class="block text-gray-700 font-medium">Upload Gambar</label>
                    <input type="file" id="gambar" name="gambar"
                        class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-red-300">
                </div>

                <button type="submit"
                    class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition">
                    Simpan Karya
                </button>
            </form>
        </div>
    </div>
</main>
@endsection
