@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Form Penulisan Karya -->
            <div class="flex-1 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">🖋️ Karya Publikasi</h2>

                <!-- Notifikasi Sukses -->
                @if(session('success'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Notifikasi Error -->
                @if ($errors->any())
                    <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('karya.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 font-medium">Judul</label>
                        <input type="text" id="judul" name="judul"
                            class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300"
                            placeholder="Masukkan judul karya..." required>
                    </div>

                    <div class="mb-4">
                        <label for="penulis" class="block text-gray-700 font-medium">Nama Penulis</label>
                        <input type="text" id="penulis" name="penulis"
                            class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300"
                            placeholder="Masukkan nama penulis..." required>
                    </div>

                    <div class="mb-4">
                        <label for="kategori" class="block text-gray-700 font-medium">Kategori</label>
                        <select id="kategori" name="kategori"
                            class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300" required>
                            <option value="puisi">Puisi</option>
                            <option value="pantun">Pantun</option>
                            <option value="syair">Syair</option>
                            <option value="fotografi">Fotografi</option>
                            <option value="desain_grafis">Desain Grafis</option>
                        </select>
                    </div>

                    <div class="mb-4" id="deskripsi-wrapper">
                        <label for="deskripsi" class="block text-gray-700 font-medium">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi"
                            class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300"
                            placeholder="Masukkan deskripsi karya..." required></textarea>
                    </div>

                    <!-- Upload File dengan Preview -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Upload Gambar</label>
                        <input type="file" id="media" name="media" accept="image/jpeg,image/png" required onchange="previewImage(event)">
                        <div class="mt-3">
                            <img id="imagePreview" class="hidden w-48 h-auto rounded-md shadow-md" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <span class="block text-sm font-bold text-gray-700">Visibilitas</span>
                        <div class="mt-3 flex items-center space-x-4">
                            <label class="flex items-center text-gray-700">
                                <input type="radio" name="visibilitas" value="public" required checked>
                                <span class="ml-2">Public</span>
                            </label>
                            <label class="flex items-center text-gray-700">
                                <input type="radio" name="visibilitas" value="private" required>
                                <span class="ml-2">Private</span>
                            </label>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition">
                            + Publikasikan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main>

<!-- Script untuk Preview Gambar -->
<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // Menyembunyikan deskripsi jika kategori adalah Fotografi atau Desain Grafis
    document.getElementById('kategori').addEventListener('change', function () {
        const deskripsiWrapper = document.getElementById('deskripsi-wrapper');
        if (this.value === 'fotografi' || this.value === 'desain_grafis') {
            deskripsiWrapper.classList.add('hidden');
        } else {
            deskripsiWrapper.classList.remove('hidden');
        }
    });
</script>

@endsection
