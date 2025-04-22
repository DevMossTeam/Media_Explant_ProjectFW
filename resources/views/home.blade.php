@extends('layouts.app')

@section('content')

<section class="py-10 px-5">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-semibold mb-2">Berita Teratas Hari Ini</h2>
        <p class="text-sm text-gray-600 mb-6">Kumpulan Berita Terbaik</p>

        <div class="grid grid-cols-12 gap-4">
            @foreach ($newsList as $index => $item)
                @php
                    $isHeadline = ($index === 1);
                    $isFirstRowLeftOrRight = ($index === 0 || $index === 2);
                    $isSecondRow = ($index >= 3);
                @endphp

                @if($isFirstRowLeftOrRight)
                    <div class="col-span-4">
                        <a href="{{ $item->article_url }}">
                            <img src="{{ $item->first_image }}" alt="{{ $item->judul }}" class="w-full h-64 object-cover rounded-lg">
                        </a>
                        <div class="mt-2 flex items-center gap-2">
                            <div class="text-xs font-semibold uppercase text-[#990505]">{{ strtoupper($item->kategori) }}</div>
                            <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal_diterbitkan)->format('d M Y') }}</div>
                        </div>
                        <h3 class="text-sm font-bold leading-snug mt-1 line-clamp-2">
                            <a href="{{ $item->article_url }}">{{ $item->judul }}</a>
                        </h3>
                    </div>

                @elseif($isHeadline)
                    <div class="col-span-4 relative">
                        <a href="{{ $item->article_url }}" class="block relative">
                            <img src="{{ $item->first_image }}" alt="{{ $item->judul }}" class="w-full h-80 object-cover rounded-lg">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#990505] via-transparent to-transparent opacity-80 rounded-lg"></div>
                            <div class="absolute bottom-0 p-4 text-white">
                                <div class="flex items-center gap-2 mb-1 text-xs font-semibold uppercase">
                                    {{ strtoupper($item->kategori) }}
                                    <div class="w-[2px] h-3.5 bg-white"></div>
                                    <span class="text-gray-100">{{ \Carbon\Carbon::parse($item->tanggal_diterbitkan)->format('d M Y') }}</span>
                                </div>
                                <h3 class="text-lg font-bold leading-snug">
                                    {{ $item->judul }}
                                </h3>
                            </div>
                        </a>
                    </div>

                @elseif($isSecondRow)
                    <div class="col-span-3">
                        <a href="{{ $item->article_url }}">
                            <img src="{{ $item->first_image }}" alt="{{ $item->judul }}" class="w-full h-40 object-cover rounded-lg">
                        </a>
                        <div class="mt-2 flex items-center gap-2">
                            <div class="text-xs font-semibold uppercase text-[#990505]">{{ strtoupper($item->kategori) }}</div>
                            <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal_diterbitkan)->format('d M Y') }}</div>
                        </div>
                        <h3 class="text-sm font-bold leading-snug mt-1 line-clamp-2">
                            <a href="{{ $item->article_url }}">{{ $item->judul }}</a>
                        </h3>
                    </div>
                @endif

            @endforeach
        </div>
    </div>
</section>

<!-- Bagian Majalah -->
<section class="mt-12">
    <div class="max-w-7xl mx-auto px-5">
        <h2 class="text-2xl font-semibold text-gray-800">Majalah</h2>
        <p class="text-gray-600 mb-4 text-lg">Kumpulan Majalah Terbaik</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            @foreach ($majalahList as $majalah)
                <div class="flex flex-col items-start">
                    <a href="{{ route('majalah.browse', ['f' => $majalah->id]) }}">
                        <canvas id="pdf-thumbnail-majalah-{{ $majalah->id }}" class="w-full h-64 object-cover rounded-lg shadow-md"></canvas>
                    </a>

                    <div class="mt-3 text-sm text-gray-700 w-full">
                        <div class="flex items-center space-x-2 text-xs mb-1">
                            <span class="text-[#990505] font-semibold uppercase">MAJALAH</span>
                            <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                            <span>{{ \Carbon\Carbon::parse($majalah->release_date)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-base font-semibold leading-tight mb-1">{{ $majalah->judul }}</h3>
                        <a href="{{ route('majalah.browse', ['f' => $majalah->id]) }}" class="text-[#5773FF] font-medium text-sm">Lihat Majalah</a>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var pdfUrl = "{{ route('majalah.pdfPreview', ['id' => $majalah->id]) }}";

                        var loadingTask = pdfjsLib.getDocument(pdfUrl);
                        loadingTask.promise.then(function(pdf) {
                            pdf.getPage(1).then(function(page) {
                                var canvas = document.getElementById('pdf-thumbnail-majalah-{{ $majalah->id }}');
                                var context = canvas.getContext('2d');

                                var viewport = page.getViewport({ scale: 1.5 });
                                canvas.width = viewport.width;
                                canvas.height = viewport.height;

                                page.render({ canvasContext: context, viewport: viewport });
                            });
                        });
                    });
                </script>
            @endforeach
        </div>
    </div>
</section>

<!-- Bagian Buletin -->
<section class="mt-16">
    <div class="max-w-7xl mx-auto px-5">
        <h2 class="text-2xl font-semibold text-gray-800">Buletin</h2>
        <p class="text-gray-600 mb-4 text-lg">Kumpulan Buletin Pilihan</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            @foreach ($buletinList as $buletin)
                <div class="flex flex-col items-start">
                    <a href="{{ route('buletin.browse', ['f' => $buletin->id]) }}">
                        <canvas id="pdf-thumbnail-buletin-{{ $buletin->id }}" class="w-full h-64 object-cover rounded-lg shadow-md"></canvas>
                    </a>

                    <div class="mt-3 text-sm text-gray-700 w-full">
                        <div class="flex items-center space-x-2 text-xs mb-1">
                            <span class="text-[#990505] font-semibold uppercase">BULETIN</span>
                            <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                            <span>{{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-base font-semibold leading-tight mb-1">{{ $buletin->judul }}</h3>
                        <a href="{{ route('buletin.browse', ['f' => $buletin->id]) }}" class="text-[#5773FF] font-medium text-sm">Lihat Buletin</a>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var pdfUrl = "{{ route('buletin.pdfPreview', ['id' => $buletin->id]) }}";

                        var loadingTask = pdfjsLib.getDocument(pdfUrl);
                        loadingTask.promise.then(function(pdf) {
                            pdf.getPage(1).then(function(page) {
                                var canvas = document.getElementById('pdf-thumbnail-buletin-{{ $buletin->id }}');
                                var context = canvas.getContext('2d');

                                var viewport = page.getViewport({ scale: 1.5 });
                                canvas.width = viewport.width;
                                canvas.height = viewport.height;

                                page.render({ canvasContext: context, viewport: viewport });
                            });
                        });
                    });
                </script>
            @endforeach
        </div>
    </div>
</section>

<!-- Bagian Puisi -->
<section class="mt-12 mb-12">
    <div class="max-w-7xl mx-auto px-5">
        <h2 class="text-2xl font-semibold text-gray-800">Puisi Terbaru</h2>
        <p class="text-gray-600 mb-4 text-lg">Kumpulan Puisi Terbaru</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            @foreach ($puisiList as $puisi)
                <div class="flex flex-col items-start">
                    <a href="{{ route('karya.puisi.read', ['k' => $puisi->id]) }}">
                        <img src="data:image/jpeg;base64,{{ $puisi->media }}" alt="{{ $puisi->judul }}" class="w-full h-64 object-cover rounded-lg shadow-md" />
                    </a>

                    <div class="mt-3 text-sm text-gray-700 w-full">
                        <div class="flex items-center space-x-2 text-xs mb-1">
                            <span class="text-[#990505] font-semibold uppercase">PUI</span>
                            <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                            <span>{{ \Carbon\Carbon::parse($puisi->release_date)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-base font-semibold leading-tight mb-1">{{ $puisi->judul }}</h3>
                        <div class="text-xs italic font-medium text-gray-800">
                            <span>Oleh : {{ $puisi->creator ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Bagian Pantun -->
<section class="mt-12">
    <div class="max-w-7xl mx-auto px-5">
        <h2 class="text-2xl font-semibold text-gray-800">Pantun</h2>
        <p class="text-gray-600 mb-4 text-lg">Kumpulan Pantun Terbaik</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            @foreach ($pantunList as $pantun)
                <div class="flex flex-col items-start">
                    <a href="{{ route('karya.pantun.read', ['k' => $pantun->id]) }}">
                        <img src="data:image/jpeg;base64,{{ $pantun->media }}" alt="{{ $pantun->judul }}" class="w-full h-64 object-cover rounded-lg shadow-md" />
                    </a>

                    <div class="mt-3 text-sm text-gray-700 w-full">
                        <div class="flex items-center space-x-2 text-xs mb-1">
                            <span class="text-[#990505] font-semibold uppercase">PANTUN</span>
                            <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                            <span>{{ \Carbon\Carbon::parse($pantun->release_date)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-base font-semibold leading-tight mb-1">{{ $pantun->judul }}</h3>
                        <div class="text-xs italic font-medium text-gray-800">
                            <span>Oleh : {{ $pantun->creator ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Bagian Syair -->
<section class="mt-12">
    <div class="max-w-7xl mx-auto px-5">
        <h2 class="text-2xl font-semibold text-gray-800">Syair</h2>
        <p class="text-gray-600 mb-4 text-lg">Kumpulan Syair Terbaik</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            @foreach ($syairList as $syair)
                <div class="flex flex-col items-start">
                    <a href="{{ route('karya.syair.read', ['k' => $syair->id]) }}">
                        <img src="data:image/jpeg;base64,{{ $syair->media }}" alt="{{ $syair->judul }}" class="w-full h-64 object-cover rounded-lg shadow-md" />
                    </a>

                    <div class="mt-3 text-sm text-gray-700 w-full">
                        <div class="flex items-center space-x-2 text-xs mb-1">
                            <span class="text-[#990505] font-semibold uppercase">SYAIR</span>
                            <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                            <span>{{ \Carbon\Carbon::parse($syair->release_date)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-base font-semibold leading-tight mb-1">{{ $syair->judul }}</h3>
                        <div class="text-xs italic font-medium text-gray-800">
                            <span>Oleh : {{ $syair->creator ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Bagian Fotografi -->
<section class="mt-12">
    <div class="max-w-7xl mx-auto px-5">
        <h2 class="text-2xl font-semibold text-gray-800">Fotografi</h2>
        <p class="text-gray-600 mb-4 text-lg">Kumpulan Fotografi Terbaik</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            @foreach ($fotografiList as $fotografi)
                <div class="flex flex-col items-start">
                    <a href="{{ route('karya.fotografi.read', ['k' => $fotografi->id]) }}">
                        <img src="data:image/jpeg;base64,{{ $fotografi->media }}" alt="{{ $fotografi->judul }}" class="w-full h-64 object-cover rounded-lg shadow-md" />
                    </a>

                    <div class="mt-3 text-sm text-gray-700 w-full">
                        <div class="flex items-center space-x-2 text-xs mb-1">
                            <span class="text-[#990505] font-semibold uppercase">FOTOGRAFI</span>
                            <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                            <span>{{ \Carbon\Carbon::parse($fotografi->release_date)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-base font-semibold leading-tight mb-1">{{ $fotografi->judul }}</h3>
                        <div class="text-xs italic font-medium text-gray-800">
                            <span>Oleh : {{ $fotografi->creator ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Bagian Desain Grafis -->
<section class="mt-12 mb-12">
    <div class="max-w-7xl mx-auto px-5">
        <h2 class="text-2xl font-semibold text-gray-800">Desain Grafis</h2>
        <p class="text-gray-600 mb-4 text-lg">Kumpulan Desain Grafis Terbaik</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            @foreach ($desainGrafisList as $desainGrafis)
                <div class="flex flex-col items-start">
                    <a href="{{ route('karya.desain-grafis.read', ['k' => $desainGrafis->id]) }}">
                        <img src="data:image/jpeg;base64,{{ $desainGrafis->media }}" alt="{{ $desainGrafis->judul }}" class="w-full h-64 object-cover rounded-lg shadow-md" />
                    </a>

                    <div class="mt-3 text-sm text-gray-700 w-full">
                        <div class="flex items-center space-x-2 text-xs mb-1">
                            <span class="text-[#990505] font-semibold uppercase">DESAIN GRAFIS</span>
                            <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                            <span>{{ \Carbon\Carbon::parse($desainGrafis->release_date)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-base font-semibold leading-tight mb-1">{{ $desainGrafis->judul }}</h3>
                        <div class="text-xs italic font-medium text-gray-800">
                            <span>Oleh : {{ $desainGrafis->creator ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Tambahkan Library PDF.js sekali di akhir halaman -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>

@endsection
