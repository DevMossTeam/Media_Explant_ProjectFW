@extends('layouts.app')

@section('content')
    <main class="py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-6">

                <!-- Form Penulisan Produk -->
                <div class="flex-1 bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">📰 Form Penulisan Produk</h2>

                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 font-medium">Judul</label>
                        <input type="text" id="judul" name="judul"
                            class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300"
                            placeholder="Masukkan judul produk...">
                    </div>

                    <!-- Upload File -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Upload File</label>
                        <div id="drop-area"
                            class="mt-1 flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-md cursor-pointer">
                            <input id="file-upload" name="file" type="file" class="hidden" accept=".pdf,.jpg,.png,.jpeg">
                            <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 4v12m0 0l-3-3m3 3l3-3M4 16h16">
                                </path>
                            </svg>
                            <p class="text-sm text-gray-600 mt-2">Seret dan jatuhkan file di sini atau klik untuk unggah</p>
                            <p class="text-xs text-gray-500">PDF, JPG, PNG (maks. 10MB)</p>
                        </div>

                        <div id="preview-container" class="mt-4 hidden relative text-center">
                            <button id="remove-file" type="button"
                                class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700 transition">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.225 4.811a1.125 1.125 0 011.59 0L12 8.997l4.185-4.186a1.125 1.125 0 011.59 1.59L13.59 10.59l4.185 4.185a1.125 1.125 0 01-1.59 1.59L12 12.183l-4.185 4.186a1.125 1.125 0 01-1.59-1.59l4.185-4.185-4.185-4.186a1.125 1.125 0 010-1.59z">
                                    </path>
                                </svg>
                            </button>

                            <img id="preview-image" class="max-w-full rounded-md shadow-md hidden mx-auto"
                                style="max-width: 300px;" alt="Preview">
                            <canvas id="pdf-canvas" class="max-w-full rounded-md shadow-md hidden mx-auto"
                                style="max-width: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Pengaturan Publikasi -->
                <div class="w-full lg:w-1/3 bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">⚙️ Pengaturan Publikasi</h2>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label for="kategori" class="block text-gray-700 font-medium">Kategori</label>
                        <p class="text-sm text-gray-500 mt-1">Pilih kategori yang paling sesuai dengan produk Anda.</p>
                        <select id="kategori" name="kategori"
                            class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300">
                            <option value="buletin">Buletin</option>
                            <option value="majalah">Majalah</option>
                        </select>
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
                        <button type="submit"
                            class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition">
                            + Publikasikan
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Script untuk unggah dan preview file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fileInput = document.getElementById("file-upload");
            const dropArea = document.getElementById("drop-area");
            const previewContainer = document.getElementById("preview-container");
            const previewImage = document.getElementById("preview-image");
            const pdfCanvas = document.getElementById("pdf-canvas");
            const removeFileButton = document.getElementById("remove-file");

            dropArea.addEventListener("click", function () {
                fileInput.click();
            });

            fileInput.addEventListener("change", function (event) {
                const file = event.target.files[0];
                if (file) {
                    previewFile(file);
                }
            });

            function previewFile(file) {
                const reader = new FileReader();
                dropArea.classList.add("hidden"); // Sembunyikan area unggah

                if (file.type.startsWith("image/")) {
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove("hidden");
                        pdfCanvas.classList.add("hidden");
                        previewContainer.classList.remove("hidden");
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === "application/pdf") {
                    reader.onload = function (e) {
                        const loadingTask = pdfjsLib.getDocument({ data: e.target.result });
                        loadingTask.promise.then(pdf => {
                            pdf.getPage(1).then(page => {
                                const scale = 1;
                                const viewport = page.getViewport({ scale });
                                const context = pdfCanvas.getContext("2d");
                                pdfCanvas.width = viewport.width;
                                pdfCanvas.height = viewport.height;
                                previewImage.classList.add("hidden");
                                pdfCanvas.classList.remove("hidden");
                                previewContainer.classList.remove("hidden");

                                const renderContext = { canvasContext: context, viewport: viewport };
                                page.render(renderContext);
                            });
                        }).catch(error => {
                            console.error("Error loading PDF: ", error);
                        });
                    };
                    reader.readAsArrayBuffer(file);
                } else {
                    alert("Format file tidak didukung!");
                }
            }

            removeFileButton.addEventListener("click", function () {
                previewContainer.classList.add("hidden"); // Sembunyikan preview
                previewImage.classList.add("hidden");
                pdfCanvas.classList.add("hidden");
                dropArea.classList.remove("hidden"); // Tampilkan kembali area unggah
                fileInput.value = ""; // Reset input file
            });
        });
    </script>

@endsection
