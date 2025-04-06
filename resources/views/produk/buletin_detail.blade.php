@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6 max-w-5xl">
    <!-- Breadcrumb -->
    <div class="mb-4">
        <span class="text-red-600 font-semibold bg-red-100 px-3 py-1 rounded">Buletin</span>
    </div>

    <!-- Judul -->
    <h1 class="text-3xl font-bold italic">{{ $buletin->judul }}</h1>

    <!-- Info penulis & tanggal -->
    <div class="flex items-center text-sm text-gray-600 my-2">
        <span>Oleh : <strong>{{ $buletin->user ? $buletin->user->nama_lengkap : 'Tidak Diketahui' }}</strong></span>
        <span class="mx-2">•</span>
        <span>{{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('j M Y') }}</span>

        <!-- Bookmark ikon (frontend-only) -->
        <div class="ml-auto">
            <button class="text-gray-400 hover:text-gray-800" title="Simpan dan baca nanti">
                <i class="far fa-bookmark text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Thumbnail PDF -->
    <div class="my-4">
        <iframe src="{{ route('buletin.pdfPreview', ['id' => $buletin->id]) }}#page=1" class="w-full h-72 rounded-lg shadow border" type="application/pdf"></iframe>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex gap-4 mb-4">
        <a href="{{ route('buletin.download', ['id' => $buletin->id]) }}"
           class="bg-[#5773FF] hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            <i class="fas fa-download mr-2"></i>Unduh Sekarang
        </a>

        <button id="toggle-preview" data-id="{{ $buletin->id }}"
           class="bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-lg shadow">
            <i class="fas fa-eye mr-2"></i>Pratinjau
        </button>
    </div>

    <!-- Modal Container -->
    <div id="previewModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 flex items-center justify-center">
        <div class="bg-white w-full max-w-6xl h-[85vh] rounded-xl shadow-lg relative flex flex-col mx-auto my-auto">
            <div class="flex justify-between items-center px-6 py-4 border-b">
                <h2 class="text-lg font-semibold">Pratinjau Buletin</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
            </div>
            <div class="flex-1 overflow-hidden" id="modalContent">
                <div class="w-full h-full flex items-center justify-center text-gray-500">Memuat pratinjau...</div>
            </div>
        </div>
    </div>

    <!-- Reaksi -->
    <div class="flex items-center gap-6 mt-6 text-gray-700">
        <button class="flex items-center gap-2"><i class="fas fa-thumbs-up"></i> 107</button>
        <button class="flex items-center gap-2"><i class="fas fa-thumbs-down"></i> 0</button>
        <button class="flex items-center gap-2"><i class="fas fa-share"></i> 0</button>
        <button class="ml-auto text-red-600 hover:text-red-800" title="Laporkan">
            <i class="fas fa-flag"></i>
        </button>
    </div>

    <!-- Rekomendasi Hari Ini -->
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-3 text-red-700">
            <span class="bg-red-100 px-3 py-1 rounded">Rekomendasi Hari ini</span>
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($rekomendasiBuletin as $item)
                <div class="bg-white rounded-lg shadow p-2">
                    <iframe src="{{ route('buletin.pdfPreview', ['id' => $item->id]) }}#page=1"
                            class="w-full h-40 rounded" type="application/pdf"></iframe>

                    <div class="mt-2 text-xs text-red-600 font-semibold">BULETIN | {{ \Carbon\Carbon::parse($item->release_date)->translatedFormat('d M Y') }}</div>
                    <div class="text-sm font-semibold">{{ $item->judul }}</div>

                    <a href="{{ route('buletin.download', ['id' => $item->id]) }}"
                       class="mt-1 inline-block text-blue-600 hover:underline text-sm">
                        <i class="fas fa-download"></i> Unduh Sekarang
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $rekomendasiBuletin->links() }}
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

        const id = previewBtn.dataset.id;
        const browseUrl = `/produk/buletin/browse?f=${id}`;
        const previewUrl = `/produk/buletin/preview?f=${id}`;

        function openModal() {
            modal.classList.remove("hidden");
            fetch(previewUrl)
                .then(res => res.text())
                .then(html => {
                    modalContent.innerHTML = html;
                });
        }

        function closeModal() {
            modal.classList.add("hidden");
            modalContent.innerHTML = `<div class="w-full h-full flex items-center justify-center text-gray-500">Memuat pratinjau...</div>`;
        }

        previewBtn.addEventListener("click", () => {
            history.pushState({ preview: true }, '', previewUrl);
            openModal();
        });

        closeBtn.addEventListener("click", () => {
            history.pushState(null, '', browseUrl);
            closeModal();
        });

        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                history.pushState(null, '', browseUrl);
                closeModal();
            }
        });

        window.addEventListener("popstate", function () {
            if (window.location.pathname.includes('/preview')) {
                openModal();
            } else {
                closeModal();
            }
        });

        if (window.location.pathname.includes('/preview')) {
            openModal();
        }
    });
</script>

@endsection
