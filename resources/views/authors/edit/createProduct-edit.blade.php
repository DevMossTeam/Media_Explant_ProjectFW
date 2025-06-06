@extends('layouts.app')

@section('content')
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $produk->judul) }}" class="w-full p-2 border rounded-lg"
                required>
        </div>

        <!-- Cover -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-1">Unggah Cover</label>
            <div id="cover-drop-area"
                class="border-dashed border-2 border-gray-300 p-4 text-center cursor-pointer relative rounded-lg hover:border-blue-500 transition">
                <p class="text-gray-500 mb-2">Klik di sini untuk mengunggah</p>
                <input type="file" name="cover" id="coverInput" accept=".jpg,.jpeg,.png" class="hidden">
                <p id="cover-error" class="text-red-500 text-sm mt-1 hidden"></p>

                <div id="cover-preview" class="relative mx-auto max-w-xs rounded overflow-hidden shadow-md">
                    <img id="cover-preview-img" src="{{ $produk->cover }}" alt="Preview Cover"
                        class="w-full h-auto object-cover rounded" />
                    <button type="button" id="cover-clear-btn"
                        class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700 transition">
                        &times;
                    </button>
                </div>
            </div>
            <p class="text-gray-500 text-sm mt-1">Hanya gambar JPG/PNG, maks 10 MB</p>
        </div>

        <!-- Media PDF -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-1">Unggah File</label>
            <div id="drop-area" class="border-dashed border-2 border-gray-300 p-6 text-center cursor-pointer relative">
                <p class="text-gray-500">letakkan file di sini atau klik untuk unggah</p>
                <input type="file" name="media" class="hidden" id="fileInput" accept=".pdf">
                <p id="media-error" class="text-red-500 text-sm mt-1 hidden"></p>
            </div>
            <p class="text-gray-500 text-sm mt-1">Hanya file PDF, maks 10 MB</p>
            <p id="file-name" class="text-gray-500 mt-2"></p>

            <div id="file-preview" class="mt-4">
                <p class="text-gray-700 font-semibold">Pratinjau File:</p>
                <iframe class="w-full h-64 border rounded-lg"
                    src="{{ route('produk.media-preview', $produk->id) }}"></iframe>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="10" class="w-full border p-2 rounded-lg">{{ old('deskripsi', strip_tags($produk->deskripsi)) }}</textarea>
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-1">Kategori</label>
            <select name="kategori" required class="w-full p-2 border rounded-lg">
                <option value="Buletin" {{ $produk->kategori === 'Buletin' ? 'selected' : '' }}>Buletin</option>
                <option value="Majalah" {{ $produk->kategori === 'Majalah' ? 'selected' : '' }}>Majalah</option>
            </select>
        </div>

        <!-- Visibilitas -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-1">Visibilitas</label>
            <div class="flex space-x-4">
                <label class="flex items-center space-x-2">
                    <input type="radio" name="visibilitas" value="public"
                        {{ $produk->visibilitas === 'public' ? 'checked' : '' }}>
                    <span>Public</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="visibilitas" value="private"
                        {{ $produk->visibilitas === 'private' ? 'checked' : '' }}>
                    <span>Private</span>
                </label>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Perbarui
                Produk</button>
        </div>
    </form>

    <!-- Preview Script -->
    <script>
        document.getElementById("coverInput").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    document.getElementById("cover-preview-img").src = evt.target.result;
                    document.getElementById("cover-preview").classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById("fileInput").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById("file-name").textContent = file.name;
                const reader = new FileReader();
                reader.onload = function(evt) {
                    document.getElementById("preview-frame").src = evt.target.result;
                    document.getElementById("file-preview").classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
