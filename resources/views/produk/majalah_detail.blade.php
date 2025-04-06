@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl">
        <!-- Breadcrumb -->
        <div class="mb-4">
            <div class="flex flex-col mb-8">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                        style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Majalah
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>
        </div>

        <!-- Judul -->
        <h1 class="text-4xl font-bold italic">{{ $majalah->judul }}</h1>

        <!-- Info penulis & tanggal -->
        <div class="flex items-center text-sm text-gray-600 my-2">
            <span>Oleh : <strong>{{ $majalah->user ? $majalah->user->nama_lengkap : 'Tidak Diketahui' }}</strong></span>
            <span class="mx-2">•</span>
            <span>{{ \Carbon\Carbon::parse($majalah->release_date)->translatedFormat('j F Y - H.i') }} WIB</span>

            <!-- Bookmark ikon (frontend-only) -->
            <div class="ml-auto">
                <button class="flex items-center gap-2 text-gray-400 hover:text-gray-800" title="Simpan dan baca nanti">
                    <span class="text-sm">Simpan dan baca nanti</span>
                    <i class="far fa-bookmark text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Thumbnail PDF -->
        <div class="my-4">
            <iframe src="{{ route('majalah.pdfPreview', ['id' => $majalah->id]) }}#page=1"
                class="w-full h-72 rounded-lg shadow border" type="application/pdf"></iframe>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex gap-4 mb-4">
            <a href="{{ route('majalah.download', ['id' => $majalah->id]) }}"
                class="bg-[#5773FF] hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow w-1/2 text-center">
                <i class="fas fa-download"></i> Unduh Sekarang
            </a>

            <button id="toggle-preview" data-id="{{ $majalah->id }}"
                class="bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-lg shadow w-1/2 text-center">
                <i class="fas fa-eye"></i> Pratinjau
            </button>
        </div>

        <!-- Modal Container -->
        <div id="previewModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 flex items-center justify-center">
            <div class="bg-white w-full max-w-6xl h-[85vh] rounded-xl shadow-lg relative flex flex-col mx-auto my-auto">
                <div class="flex justify-between items-center px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold">Pratinjau Majalah</h2>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
                </div>
                <div class="flex-1 overflow-hidden" id="modalContent">
                    <div class="w-full h-full flex items-center justify-center text-gray-500">Memuat pratinjau...</div>
                </div>
            </div>
        </div>

        <!-- Reaksi -->
        <div class="mt-6">
            <div class="text-sm font-semibold text-black mb-2">Beri Tanggapanmu :</div>
            <div class="flex items-center gap-6 text-[#ABABAB]">
                <button class="flex items-center gap-2 hover:text-gray-700">
                    <i class="fas fa-thumbs-up"></i> 107
                </button>
                <button class="flex items-center gap-2 hover:text-gray-700">
                    <i class="fas fa-thumbs-down"></i> 0
                </button>
                <button class="flex items-center gap-2 hover:text-gray-700">
                    <i class="fas fa-share-nodes"></i> 0
                </button>
                <button class="ml-auto text-red-600 hover:text-red-800 bg-red-100 rounded-full p-2" title="Laporkan">
                    <i class="fas fa-flag"></i>
                </button>
            </div>
        </div>

        <!-- Rekomendasi Hari Ini -->
        <div class="mt-10">
            <div class="flex flex-col mb-6">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                        style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                        Rekomendasi Hari Ini
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>

            <div id="rekomendasi">
                @include('produk.partials.MajalahRekomendasi', [
                    'rekomendasiMajalah' => $rekomendasiMajalah,
                ])
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
        document.addEventListener("DOMContentLoaded", function() {
            const previewBtn = document.getElementById("toggle-preview");
            const modal = document.getElementById("previewModal");
            const closeBtn = document.getElementById("closeModal");
            const modalContent = document.getElementById("modalContent");

            const id = previewBtn.dataset.id;
            const browseUrl = `/produk/majalah/browse?f=${id}`;
            const previewUrl = `/produk/majalah/preview?f=${id}`;

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
                modalContent.innerHTML =
                    `<div class="w-full h-full flex items-center justify-center text-gray-500">Memuat pratinjau...</div>`;
            }

            previewBtn.addEventListener("click", () => {
                history.pushState({
                    preview: true
                }, '', previewUrl);
                openModal();
            });

            closeBtn.addEventListener("click", () => {
                history.pushState(null, '', browseUrl);
                closeModal();
            });

            modal.addEventListener("click", function(e) {
                if (e.target === modal) {
                    history.pushState(null, '', browseUrl);
                    closeModal();
                }
            });

            window.addEventListener("popstate", function() {
                if (window.location.pathname.includes('/preview')) {
                    openModal();
                } else {
                    closeModal();
                }
            });

            if (window.location.pathname.includes('/preview')) {
                openModal();
            }

            // AJAX pagination
            document.addEventListener('click', function(e) {
                const target = e.target.closest('#rekomendasi-pagination a');
                if (target) {
                    e.preventDefault();
                    const url = target.href;

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            document.querySelector('#rekomendasi').innerHTML = html;
                        });
                }
            });
        });
    </script>
@endsection
