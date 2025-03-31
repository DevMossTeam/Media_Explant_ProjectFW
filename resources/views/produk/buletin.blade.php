@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl">
        <!-- Bagian Produk Kami & Terbaru dalam Satu Baris -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Produk Kami (Kiri) -->
            <div>
                <h1 class="text-3xl font-semibold">Produk Kami</h1>
                <p class="text-gray-600 text-lg">Kumpulan Produk Terbaik</p>
                <div class="w-full h-[2px] bg-gray-300 my-6"></div>

                @if ($buletins->isNotEmpty())
                    <div class="grid grid-cols-1 gap-10 mt-6">
                        @foreach ($buletins as $buletin)
                            <a href="{{ route('buletin.show', $buletin->id) }}"
                                class="relative block rounded-lg overflow-hidden shadow-md">
                                <canvas id="pdf-viewer-{{ $buletin->id }}" class="w-full h-96 object-cover"></canvas>

                                <!-- Overlay Gradasi -->
                                <div class="absolute inset-0 bg-gradient-to-t from-[#990505] to-transparent opacity-90">
                                </div>

                                <!-- Teks Informasi -->
                                <div class="absolute bottom-0 left-0 p-4 text-white w-full">
                                    <p class="text-sm font-medium flex items-center gap-2">
                                        <span>BULETIN</span> |
                                        <span>{{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('d M Y') }}</span>
                                    </p>

                                    <h2 class="text-lg font-semibold mt-1">{{ $buletin->judul }}</h2>

                                    <p class="text-sm mt-1 line-clamp-2">
                                        {{ $buletin->deskripsi }}
                                    </p>
                                </div>
                            </a>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var pdfUrl = "{{ route('pdf.preview', ['id' => $buletin->id]) }}";

                                    var loadingTask = pdfjsLib.getDocument(pdfUrl);
                                    loadingTask.promise.then(function(pdf) {
                                        pdf.getPage(1).then(function(page) {
                                            var canvas = document.getElementById('pdf-viewer-{{ $buletin->id }}');
                                            var context = canvas.getContext('2d');

                                            var viewport = page.getViewport({
                                                scale: 1.5
                                            });
                                            canvas.width = viewport.width;
                                            canvas.height = viewport.height;

                                            var renderContext = {
                                                canvasContext: context,
                                                viewport: viewport
                                            };
                                            page.render(renderContext);
                                        });
                                    });
                                });
                            </script>
                        @endforeach
                    </div>
                @else
                    <p>Buletin tidak ditemukan.</p>
                @endif
            </div>

            <!-- Terbaru (Kanan) -->
            <div class="mt-6">
                <div class="flex flex-col mb-8">
                    <div class="flex items-center">
                        <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                        <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                            style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                            Terbaru
                        </h2>
                    </div>
                    <div class="w-full h-[2px] bg-gray-300"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($buletinsTerbaru as $buletin)
                        <div>
                            <a href="{{ route('buletin.show', $buletin->id) }}" class="block">
                                <div class="relative rounded-lg overflow-hidden shadow-md mb-4">
                                    <canvas id="pdf-viewer-terbaru-{{ $buletin->id }}"
                                        class="w-full h-80 object-cover rounded-lg"></canvas>
                                </div>
                            </a>

                            <p class="text-sm font-semibold flex items-center text-[#990505]">
                                <span>BULETIN</span> <span class="mx-1">|</span> <span class="text-[#ABABAB]">
                                    {{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('d M Y') }}
                                </span>
                            </p>

                            <a href="{{ route('buletin.show', $buletin->id) }}" class="block">
                                <h3 class="text-lg font-semibold mt-1">{{ $buletin->judul }}</h3>
                            </a>

                            <div class="flex items-center mt-1">
                                <i class="fa-solid fa-download text-[#5773FF] mr-2"></i>
                                <a href="{{ route('buletin.show', $buletin->id) }}"
                                    class="text-[#5773FF] text-lg font-medium">Lihat Buletin</a>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var pdfUrl = "{{ route('pdf.preview', ['id' => $buletin->id]) }}";

                                var loadingTask = pdfjsLib.getDocument(pdfUrl);
                                loadingTask.promise.then(function(pdf) {
                                    pdf.getPage(1).then(function(page) {
                                        var canvas = document.getElementById('pdf-viewer-terbaru-{{ $buletin->id }}');
                                        var context = canvas.getContext('2d');

                                        var viewport = page.getViewport({
                                            scale: 1.2
                                        });
                                        canvas.width = viewport.width;
                                        canvas.height = viewport.height;

                                        var renderContext = {
                                            canvasContext: context,
                                            viewport: viewport
                                        };
                                        page.render(renderContext);
                                    });
                                });
                            });
                        </script>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Rekomendasi Hari Ini -->
        <section class="mt-12">
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

            <!-- Grid 6 kolom per baris, total 12 item (2 baris) -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($buletinsRekomendasi as $buletin)
                    <div>
                        <a href="{{ route('buletin.show', $buletin->id) }}" class="block">
                            <div class="relative rounded-lg overflow-hidden shadow-md mb-2">
                                <canvas id="pdf-viewer-rekomendasi-{{ $buletin->id }}"
                                    class="w-full h-52 object-cover rounded-lg"></canvas>
                            </div>
                        </a>

                        <p class="text-sm font-semibold flex items-center">
                            <span class="text-[#990505]">BULETIN</span>
                            <span class="mx-1 text-[#990505]">|</span>
                            <span class="text-[#ABABAB]">
                                {{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('d M Y') }}
                            </span>
                        </p>

                        <a href="{{ route('buletin.show', $buletin->id) }}" class="block">
                            <h3 class="text-lg font-semibold mt-1">{{ $buletin->judul }}</h3>
                        </a>

                        <div class="flex items-center mt-1">
                            <i class="fa-solid fa-download text-[#5773FF] mr-2"></i>
                            <a href="{{ route('buletin.show', $buletin->id) }}"
                                class="text-[#5773FF] text-lg font-medium">Unduh Sekarang</a>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var pdfUrl = "{{ route('pdf.preview', ['id' => $buletin->id]) }}";

                            var loadingTask = pdfjsLib.getDocument(pdfUrl);
                            loadingTask.promise.then(function(pdf) {
                                pdf.getPage(1).then(function(page) {
                                    var canvas = document.getElementById(
                                        'pdf-viewer-rekomendasi-{{ $buletin->id }}');
                                    var context = canvas.getContext('2d');

                                    var viewport = page.getViewport({
                                        scale: 1.2
                                    });
                                    canvas.width = viewport.width;
                                    canvas.height = viewport.height;

                                    var renderContext = {
                                        canvasContext: context,
                                        viewport: viewport
                                    };
                                    page.render(renderContext);
                                });
                            });
                        });
                    </script>
                @endforeach
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
@endsection
