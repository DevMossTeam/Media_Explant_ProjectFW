@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Bagian Kiri: Tambahkan Produk -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    📖 <span class="ml-2">Tambahkan Produk</span>
                </h2>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <form id="productForm" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-1">Judul</label>
                        <input type="text" name="judul" required placeholder="Masukkan judul produk"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Media Upload -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-1">Unggah File</label>
                        <div id="drop-area"
                            class="border-dashed border-2 border-gray-300 p-6 text-center cursor-pointer relative">
                            <p class="text-gray-500">Seret dan letakkan file di sini atau klik untuk unggah</p>
                            <input type="file" name="media" required class="hidden" id="fileInput"
                                accept=".pdf,.doc,.docx">
                        </div>
                        <p id="file-name" class="text-gray-500 mt-2"></p>

                        <!-- Preview File -->
                        <div id="file-preview" class="mt-4 hidden">
                            <p class="text-gray-700 font-semibold">Pratinjau File:</p>
                            <iframe id="preview-frame" class="w-full h-64 border rounded-lg"></iframe>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-1">Deskripsi</label>
                        <div id="editor-container"
                            class="bg-white min-h-[240px] max-h-[240px] overflow-y-auto border rounded-lg p-2"></div>
                        <input type="hidden" name="deskripsi" id="deskripsi">
                    </div>
            </div>

            <!-- Bagian Kanan: Pengaturan Publikasi -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    ⚙️ <span class="ml-2">Pengaturan Publikasi</span>
                </h2>

                <!-- Kategori -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-1">Kategori</label>
                    <p class="text-gray-500 text-sm mb-1">Pilih kategori produk yang sesuai.</p>
                    <select name="kategori" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="Buletin">Buletin</option>
                        <option value="Majalah">Majalah</option>
                    </select>
                </div>

                <!-- Visibilitas -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-1">Visibilitas</label>
                    <p class="text-gray-500 text-sm mb-1">Atur visibilitas agar dapat dilihat oleh kelompok yang diinginkan.
                    </p>
                    <div class="flex space-x-4">
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="visibilitas" value="public" checked class="focus:ring-blue-500">
                            <span>Public</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="visibilitas" value="private" class="focus:ring-blue-500">
                            <span>Private</span>
                        </label>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-between">
                    <button type="button"
                        class="bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition flex items-center">
                        <svg class="w-5 h-5 mr-2 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 12c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z">
                            </path>
                        </svg>
                        Pratinjau
                    </button>
                    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition">
                        + Publikasikan
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Quill CSS & JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        // Inisialisasi Quill Editor
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Tulis deskripsi produk di sini...',
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['link', ],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }]
                ]
            }
        });

        // Saat submit form, ambil isi Quill ke input hidden
        document.getElementById("productForm").addEventListener("submit", function() {
            document.getElementById("deskripsi").value = quill.root.innerHTML;
        });

        // Filter paste: buang gambar dan video
        quill.clipboard.addMatcher(Node.ELEMENT_NODE, function(node, delta) {
            const newOps = delta.ops.filter(op => {
                if (op.insert && typeof op.insert === 'object') {
                    return !op.insert.image && !op.insert.video;
                }
                return true;
            });
            delta.ops = newOps;
            return delta;
        });

        const dropArea = document.getElementById("drop-area");
        const fileInput = document.getElementById("fileInput");
        const fileNameDisplay = document.getElementById("file-name");
        const filePreview = document.getElementById("file-preview");
        const previewFrame = document.getElementById("preview-frame");

        dropArea.addEventListener("click", () => fileInput.click());

        // Fungsi untuk menampilkan preview file
        function previewFile(file) {
            fileNameDisplay.textContent = "File: " + file.name;

            if (file.type === "application/pdf") {
                filePreview.classList.remove("hidden");
                const fileURL = URL.createObjectURL(file);
                previewFrame.src = fileURL;
            } else {
                filePreview.classList.add("hidden");
            }
        }

        // Event listener untuk input file (klik)
        fileInput.addEventListener("change", () => {
            if (fileInput.files.length > 0) {
                previewFile(fileInput.files[0]);
            }
        });

        // Event listener untuk drag & drop
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
                const file = e.dataTransfer.files[0];
                fileInput.files = e.dataTransfer.files;
                previewFile(file);
            }
        });
    </script>
@endsection
