@extends('layouts.app')

@section('content')
    <main class="py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-6">

            <!-- Bagian Kiri: Form Input -->
            <div class="flex-1 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">🖋️ Karya Publikasi</h2>

                <!-- Notifikasi Sukses -->
                @if (session('success'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form -->
                <form id="karyaForm" action="{{ route('karya.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul -->
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 font-medium">Judul</label>
                        <input type="text" id="judul" name="judul"
                            class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300"
                            placeholder="Masukkan judul karya..." required>
                    </div>

                    <!-- Upload File -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Upload File</label>
                        <div id="drop-area"
                            class="border-dashed border-2 border-gray-400 p-6 rounded-md flex flex-col items-center justify-center text-center cursor-pointer relative">
                            <input type="file" id="media" name="media" accept="image/jpeg,image/png" class="hidden"
                                required>

                            <!-- Ikon Unggah -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-500 mb-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M4 12l8-8 8 8"></path>
                                <path d="M12 20V4"></path>
                            </svg>

                            <p class="text-gray-600 text-sm">Seret dan jatuhkan file di sini atau klik untuk unggah<br><span
                                    class="text-xs">JPG, PNG (maks. 10MB)</span></p>

                            <!-- Preview Gambar -->
                            <div id="preview-container" class="hidden mt-3 relative">
                                <img id="imagePreview" class="w-48 h-auto rounded-md shadow-md" />
                                <button id="removePreview" type="button"
                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2 py-1 text-sm">X</button>
                            </div>
                        </div>
                    </div>

                    <!-- Caption -->
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-gray-700 font-medium">Caption</label>
                        <textarea id="deskripsi" name="deskripsi" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300"
                            placeholder="Tambahkan caption di sini..."></textarea>
                    </div>

                    <!-- Nama Penulis -->
                    <div class="mb-4">
                        <label for="penulis" class="block text-gray-700 font-medium">Nama Penulis</label>
                        <input type="text" id="penulis" name="penulis"
                            class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300"
                            placeholder="Masukkan nama penulis..." required>
                    </div>
            </div>

            <!-- Bagian Kanan: Pengaturan -->
            <div class="w-full lg:w-1/3 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">⚙️ Pengaturan Publikasi</h2>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-gray-700 font-bold">Kategori</label>
                    <p class="text-gray-500 text-sm mb-2">Pilih kategori produk yang sesuai.</p>
                    <select id="kategori" name="kategori"
                        class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300" required>
                        <option value="puisi">Puisi</option>
                        <option value="pantun">Pantun</option>
                        <option value="syair">Syair</option>
                        <option value="fotografi">Fotografi</option>
                        <option value="desain_grafis">Desain Grafis</option>
                    </select>
                </div>

                <!-- Visibilitas -->
                <div class="mb-4">
                    <span class="block text-sm font-bold text-gray-700">Visibilitas</span>
                    <p class="text-gray-500 text-sm mb-2">Atur visibilitas agar dapat dilihat oleh kelompok yang diinginkan.
                    </p>
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
                    <button type="button"
                        class="bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition flex items-center">
                        <svg class="w-5 h-5 mr-2 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 12c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z">
                            </path>
                        </svg>
                        Pratinjau
                    </button>
                    <button type="submit" id="publishBtn"
                        class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition">
                        + Publikasikan
                    </button>
                </div>
            </div>
            </form>
        </div>
    </main>

    <!-- Modal Peringatan -->
    <div id="warningModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-md w-1/3 relative">
            <h2 class="text-xl font-semibold text-red-600">⚠️ Peringatan</h2>
            <p class="mt-3 text-gray-700">Nama penulis hanya boleh berisi huruf, tanpa angka!</p>
            <div class="mt-4 flex justify-end">
                <button id="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded-md">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropArea = document.getElementById("drop-area");
            const fileInput = document.getElementById("media");
            const imagePreview = document.getElementById("imagePreview");
            const previewContainer = document.getElementById("preview-container");
            const removePreview = document.getElementById("removePreview");

            // Klik area untuk upload
            dropArea.addEventListener("click", () => fileInput.click());

            // Preview gambar saat file dipilih
            fileInput.addEventListener("change", previewImage);

            // Hapus preview tanpa membuka dialog file
            removePreview.addEventListener("click", function(event) {
                event.stopPropagation(); // Mencegah pemicuan klik pada drop area
                fileInput.value = ""; // Reset input file
                previewContainer.classList.add("hidden");
            });

            // Drag & Drop
            dropArea.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropArea.classList.add("border-blue-500");
            });

            dropArea.addEventListener("dragleave", () => {
                dropArea.classList.remove("border-blue-500");
            });

            dropArea.addEventListener("drop", (e) => {
                e.preventDefault();
                dropArea.classList.remove("border-blue-500");

                if (e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;
                    previewImage();
                }
            });

            function previewImage() {
                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        imagePreview.src = e.target.result;
                        previewContainer.classList.remove("hidden");
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("warningModal");
            const closeModalBtn = document.getElementById("closeModal");

            // Fungsi untuk menutup modal
            function closeModal() {
                modal.classList.add("hidden");
            }

            // Cek input nama penulis saat submit
            document.getElementById("karyaForm").addEventListener("submit", function(event) {
                let penulis = document.getElementById("penulis").value;
                let regex = /^[a-zA-Z\s]+$/;

                if (!regex.test(penulis)) {
                    event.preventDefault(); // Cegah submit
                    modal.classList.remove("hidden");
                }
            });

            // Tutup modal dengan tombol "Tutup"
            closeModalBtn.addEventListener("click", closeModal);

            // Tutup modal dengan klik di luar modal
            modal.addEventListener("click", function(event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            // Tutup modal dengan tombol "Esc"
            document.addEventListener("keydown", function(event) {
                if (event.key === "Escape") {
                    closeModal();
                }
            });
        });
    </script>
@endsection
