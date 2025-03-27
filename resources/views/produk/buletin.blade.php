@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>
</head>

<div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl">

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <h2 class="text-3xl font-semibold">Produk Kami</h2>
            <p class="text-gray-600 mb-2 text-lg">Kumpulan Produk Terbaik</p>
            <div class="w-full h-[2px] bg-gray-300"></div>

            <div class="grid grid-cols-1 gap-8 mt-4">
                @if(isset($buletin))
                    <div class="relative rounded-lg overflow-hidden shadow-md">
                        <div id="pdf-container" class="w-full h-96 bg-gray-200 flex items-center justify-center">
                            <canvas id="pdf-render"></canvas>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-[#990505] to-transparent opacity-90"></div>

                        <div class="absolute bottom-0 left-0 p-4 text-white w-full">
                            <p class="text-sm font-medium flex items-center gap-2">
                                <span>BULETIN</span> |
                                <span>{{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('d M Y') }}</span>
                            </p>

                            <h2 class="text-lg font-semibold mt-1">{{ $buletin->judul }}</h2>
                        </div>

                        <div class="absolute bottom-4 right-4">
                            <img src="https://img.icons8.com/ios-filled/50/ffffff/pdf.png" alt="PDF Icon" class="w-10 h-10">
                        </div>
                    </div>
                @else
                    <p class="text-gray-500">Buletin tidak ditemukan.</p>
                @endif
            </div>
        </div>
    </section>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var pdfData = atob("{{ $pdfData ?? '' }}"); // Decode Base64

        var loadingTask = pdfjsLib.getDocument({data: new Uint8Array([...pdfData].map(c => c.charCodeAt(0)))});
        loadingTask.promise.then(function(pdf) {
            return pdf.getPage(1);
        }).then(function(page) {
            var canvas = document.getElementById('pdf-render');
            var ctx = canvas.getContext('2d');
            var viewport = page.getViewport({ scale: 1.5 });

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            page.render(renderContext);
        }).catch(function(error) {
            console.error('Error loading PDF:', error);
        });
    });
</script>

@endsection
