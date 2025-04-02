@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <!-- Bagian Produk Kami -->
        <section class="lg:col-span-2">
            <h2 class="text-3xl font-semibold">Produk Kami</h2>
            <p class="text-gray-600 mb-2 text-lg">Kumpulan Produk Terbaik</p>
            <div class="w-full h-[2px] bg-gray-300 mb-6"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($majalahs as $majalah)
                    <div class="flex items-start space-x-4">
                        <a href="{{ route('majalah.show', $majalah->id) }}">
                            <canvas id="pdf-thumbnail-{{ $majalah->id }}" class="w-40 h-52 object-cover rounded-lg shadow-md"></canvas>
                        </a>

                        <div class="flex-1">
                            <div class="flex items-start space-x-2 text-sm text-gray-700 mb-1">
                                <span class="text-[#990505] font-semibold">MAJALAH |</span>
                                <span>{{ \Carbon\Carbon::parse($majalah->release_date)->translatedFormat('d M Y') }}</span>
                            </div>

                            <h3 class="text-lg font-semibold leading-tight">{{ $majalah->judul }}</h3>
                            <a href="{{ route('majalah.show', $majalah->id) }}" class="text-[#5773FF] font-medium text-sm">Lihat Majalah</a>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var pdfUrl = "{{ route('pdf.preview', ['id' => $majalah->id]) }}";

                            var loadingTask = pdfjsLib.getDocument(pdfUrl);
                            loadingTask.promise.then(function(pdf) {
                                pdf.getPage(1).then(function(page) {
                                    var canvas = document.getElementById('pdf-thumbnail-{{ $majalah->id }}');
                                    var context = canvas.getContext('2d');

                                    var viewport = page.getViewport({ scale: 1.5 });
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

        <!-- Bagian Terbaru -->
        <section class="lg:col-span-1 mt-4">
            <div class="flex flex-col mb-6">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]">
                        Terbaru
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                @foreach ($majalahsTerbaru as $majalah)
                    <div class="flex items-start space-x-4">
                        <a href="{{ route('majalah.show', $majalah->id) }}">
                            <canvas id="pdf-thumbnail-terbaru-{{ $majalah->id }}" class="w-28 h-40 object-cover rounded-lg shadow-md"></canvas>
                        </a>

                        <div class="flex-1">
                            <div class="flex items-start space-x-2 text-sm text-gray-700 mb-1">
                                <span class="text-[#990505] font-semibold">MAJALAH |</span>
                                <span>{{ \Carbon\Carbon::parse($majalah->release_date)->translatedFormat('d M Y') }}</span>
                            </div>

                            <h3 class="text-sm font-semibold leading-tight">{{ $majalah->judul }}</h3>
                            <a href="{{ route('majalah.show', $majalah->id) }}" class="text-[#5773FF] text-xs font-medium">Lihat Majalah</a>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var pdfUrl = "{{ route('pdf.preview', ['id' => $majalah->id]) }}";

                            var loadingTask = pdfjsLib.getDocument(pdfUrl);
                            loadingTask.promise.then(function(pdf) {
                                pdf.getPage(1).then(function(page) {
                                    var canvas = document.getElementById('pdf-thumbnail-terbaru-{{ $majalah->id }}');
                                    var context = canvas.getContext('2d');

                                    var viewport = page.getViewport({ scale: 1.2 });
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
</div>

<!-- Tambahkan Library PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>

@endsection
