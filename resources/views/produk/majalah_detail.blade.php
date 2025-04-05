@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6 max-w-5xl">
    <!-- Judul dan informasi -->
    <h1 class="text-3xl font-bold mb-2">{{ $majalah->judul }}</h1>
    <p class="text-gray-700">Oleh: <strong>{{ $majalah->user ? $majalah->user->nama_lengkap : 'Tidak Diketahui' }}</strong></p>
    <p class="text-gray-500 mb-4">{{ \Carbon\Carbon::parse($majalah->release_date)->translatedFormat('d M Y') }}</p>

    <!-- Tombol Unduh dan Pratinjau -->
    <div class="flex gap-4 mb-6">
        <a href="{{ route('majalah.download', ['id' => $majalah->id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            <i class="fas fa-download"></i> Unduh Sekarang
        </a>
        <button
            id="toggle-preview"
            data-id="{{ $majalah->id }}"
            class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg shadow">
            <i class="fas fa-eye"></i> Pratinjau
        </button>
    </div>

    <a href="{{ route('majalah.index') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
        Kembali
    </a>
</div>

<!-- Modal Container -->
<div id="previewModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-60">
    <div class="bg-white w-full max-w-6xl h-[85vh] rounded-xl shadow-lg relative flex flex-col mx-auto my-auto">
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-lg font-semibold">Pratinjau Majalah</h2>
            <button id="closeModal" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>

        <!-- Body -->
        <div class="flex-1 overflow-hidden" id="modalContent">
            <!-- AJAX content from majalah_preview.blade.php will be loaded here -->
            <div class="w-full h-full flex items-center justify-center text-gray-500">Memuat pratinjau...</div>
        </div>
    </div>
</div>

<!-- DearFlip CSS -->
<link rel="stylesheet" href="{{ asset('dflip/css/dflip.min.css') }}">

<!-- jQuery + DearFlip -->
<script src="{{ asset('dflip/js/libs/jquery.min.js') }}"></script>
<script src="{{ asset('dflip/js/dflip.min.js') }}"></script>

<!-- Modal Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const previewBtn = document.getElementById("toggle-preview");
        const modal = document.getElementById("previewModal");
        const closeBtn = document.getElementById("closeModal");
        const modalContent = document.getElementById("modalContent");

        previewBtn.addEventListener("click", () => {
            const id = previewBtn.dataset.id;
            const previewUrl = `/produk/majalah/preview?f=${id}`;

            // Update URL di address bar tanpa reload
            history.pushState(null, '', previewUrl);

            // Tampilkan modal
            modal.classList.remove("hidden");

            // Ambil konten dari view preview
            fetch(previewUrl)
                .then(response => response.text())
                .then(html => {
                    modalContent.innerHTML = html;
                });
        });

        closeBtn.addEventListener("click", () => {
            modal.classList.add("hidden");
            history.pushState(null, '', `/produk/majalah/browse?f={{ $majalah->id }}`);
        });

        modal.addEventListener("click", function(e) {
            if (e.target === modal) {
                modal.classList.add("hidden");
                history.pushState(null, '', `/produk/majalah/browse?f={{ $majalah->id }}`);
            }
        });
    });
</script>

@endsection
