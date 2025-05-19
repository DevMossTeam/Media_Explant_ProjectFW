@extends('layouts.app')

@section('content')
    <!-- SLIDER BERITA TERBARU -->
    <section class="mt-8 mb-10">
        <div class="max-w-7xl mx-auto px-5">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($sliderNews as $item)
                        <div class="swiper-slide relative">
                            <a href="{{ $item->article_url }}" class="block relative">
                                <img src="{{ $item->first_image }}" alt="{{ $item->judul }}"
                                    class="w-full h-96 object-cover rounded-lg">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#990505] via-transparent to-transparent opacity-80 rounded-lg">
                                </div>
                                <div class="absolute bottom-0 p-6 text-white">
                                    <div class="flex items-center gap-2 mb-2 text-xs font-semibold uppercase">
                                        {{ strtoupper($item->kategori) }}
                                        <div class="w-[2px] h-3.5 bg-white"></div>
                                        <span class="text-gray-100">
                                            {{ \Carbon\Carbon::parse($item->tanggal_diterbitkan)->format('d M Y') }}
                                        </span>
                                    </div>
                                    <h3 class="text-2xl font-bold leading-snug">
                                        {{ $item->judul }}
                                    </h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination bullet -->
                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>
    </section>

    <section class="mt-6 pt-4 px-5">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-semibold mb-2">Berita Teratas Hari Ini</h2>
            <p class="text-sm text-gray-600 mb-6">Kumpulan Berita Terbaik</p>

            <div class="grid grid-cols-12 gap-4">
                @foreach ($newsList as $index => $item)
                    @php
                        $isHeadline = $index <= 2;
                        $isSecondRow = $index >= 3;
                    @endphp

                    @if ($isHeadline)
                        <div class="col-span-4 relative">
                            <a href="{{ $item->article_url }}" class="block relative">
                                <img src="{{ $item->first_image }}" alt="{{ $item->judul }}"
                                    class="w-full h-80 object-cover rounded-lg">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#990505] via-transparent to-transparent opacity-80 rounded-lg">
                                </div>
                                <div class="absolute bottom-0 p-4 text-white">
                                    <div class="flex items-center gap-2 mb-1 text-xs font-semibold uppercase">
                                        {{ strtoupper($item->kategori) }}
                                        <div class="w-[2px] h-3.5 bg-white"></div>
                                        <span
                                            class="text-gray-100">{{ \Carbon\Carbon::parse($item->tanggal_diterbitkan)->format('d M Y') }}</span>
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
                                <img src="{{ $item->first_image }}" alt="{{ $item->judul }}"
                                    class="w-full h-40 object-cover rounded-lg">
                            </a>
                            <div class="mt-2 flex items-center gap-2">
                                <div class="text-xs font-semibold uppercase text-[#990505]">
                                    {{ strtoupper($item->kategori) }}</div>
                                <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->tanggal_diterbitkan)->format('d M Y') }}</div>
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
            <!-- Judul Atas -->
            <div class="mb-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Produk Kami</h1>
                <p class="text-sm md:text-base text-gray-700">Kumpulan Produk Terbaik</p>
                <div class="w-full h-[1px] bg-[#000000]"></div>
            </div>

            <!-- Heading Majalah -->
            <div class="flex flex-col mb-6">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                        style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Majalah
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                @foreach ($majalahList as $majalah)
                    <div class="flex flex-col items-start">
                        <a href="{{ route('majalah.browse', ['f' => $majalah->id]) }}">
                            <canvas id="pdf-thumbnail-majalah-{{ $majalah->id }}"
                                class="w-full h-64 object-cover rounded-lg shadow-md"></canvas>
                        </a>

                        <div class="mt-3 text-sm text-gray-700 w-full">
                            <div class="flex items-center space-x-2 text-xs mb-1">
                                <span class="text-[#990505] font-semibold uppercase">MAJALAH</span>
                                <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                                <span>{{ \Carbon\Carbon::parse($majalah->release_date)->translatedFormat('d M Y') }}</span>
                            </div>
                            <h3 class="text-base font-semibold leading-tight mb-1">{{ $majalah->judul }}</h3>
                            <a href="{{ route('majalah.browse', ['f' => $majalah->id]) }}"
                                class="text-[#5773FF] font-medium text-sm">Lihat Majalah</a>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var pdfUrl = "{{ route('majalah.pdfPreview', ['id' => $majalah->id]) }}";

                            var loadingTask = pdfjsLib.getDocument(pdfUrl);
                            loadingTask.promise.then(function(pdf) {
                                pdf.getPage(1).then(function(page) {
                                    var canvas = document.getElementById(
                                        'pdf-thumbnail-majalah-{{ $majalah->id }}');
                                    var context = canvas.getContext('2d');

                                    var viewport = page.getViewport({
                                        scale: 1.5
                                    });
                                    canvas.width = viewport.width;
                                    canvas.height = viewport.height;

                                    page.render({
                                        canvasContext: context,
                                        viewport: viewport
                                    });
                                });
                            });
                        });
                    </script>
                @endforeach

                @if ($majalahList->count() > 5)
                    <div class="col-start-5 col-span-full flex justify-end items-end w-full">
                        <a href="{{ url('/produk/majalah') }}" class="text-red-700 font-semibold text-sm">Selengkapnya
                            >></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Bagian Buletin -->
    <section class="mt-16">
        <div class="max-w-7xl mx-auto px-5">
            <div class="flex flex-col mb-6">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                        style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Buletin
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                @foreach ($buletinList as $buletin)
                    <div class="flex flex-col items-start">
                        <a href="{{ route('buletin.browse', ['f' => $buletin->id]) }}">
                            <canvas id="pdf-thumbnail-buletin-{{ $buletin->id }}"
                                class="w-full h-64 object-cover rounded-lg shadow-md"></canvas>
                        </a>

                        <div class="mt-3 text-sm text-gray-700 w-full">
                            <div class="flex items-center space-x-2 text-xs mb-1">
                                <span class="text-[#990505] font-semibold uppercase">BULETIN</span>
                                <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                                <span>{{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('d M Y') }}</span>
                            </div>
                            <h3 class="text-base font-semibold leading-tight mb-1">{{ $buletin->judul }}</h3>
                            <a href="{{ route('buletin.browse', ['f' => $buletin->id]) }}"
                                class="text-[#5773FF] font-medium text-sm">Lihat Buletin</a>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var pdfUrl = "{{ route('buletin.pdfPreview', ['id' => $buletin->id]) }}";

                            var loadingTask = pdfjsLib.getDocument(pdfUrl);
                            loadingTask.promise.then(function(pdf) {
                                pdf.getPage(1).then(function(page) {
                                    var canvas = document.getElementById(
                                        'pdf-thumbnail-buletin-{{ $buletin->id }}');
                                    var context = canvas.getContext('2d');

                                    var viewport = page.getViewport({
                                        scale: 1.5
                                    });
                                    canvas.width = viewport.width;
                                    canvas.height = viewport.height;

                                    page.render({
                                        canvasContext: context,
                                        viewport: viewport
                                    });
                                });
                            });
                        });
                    </script>
                @endforeach

                @if ($buletinList->count() > 5)
                    <div class="col-start-5 col-span-full flex justify-end items-end w-full">
                        <a href="{{ url('/produk/buletin') }}" class="text-red-700 font-semibold text-sm">Selengkapnya
                            >></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Bagian Puisi -->
    <section class="mt-12 mb-12">
        <div class="max-w-7xl mx-auto px-5">

            <!-- Judul Atas -->
            <div class="mb-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Karya Kami</h1>
                <p class="text-sm md:text-base text-gray-700">Kumpulan Karya Terbaik</p>
                <div class="w-full h-[1px] bg-[#000000]"></div>
            </div>

            <div class="flex flex-col mb-6">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                        style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Puisi
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                @foreach ($puisiList as $puisi)
                    <div class="flex flex-col items-start">
                        <a href="{{ route('karya.puisi.read', ['k' => $puisi->id]) }}">
                            <img src="data:image/jpeg;base64,{{ $puisi->media }}" alt="{{ $puisi->judul }}"
                                class="w-full h-64 object-cover rounded-lg shadow-md" />
                        </a>

                        <div class="mt-3 text-sm text-gray-700 w-full">
                            <div class="flex items-center space-x-2 text-xs mb-1">
                                <span class="text-[#990505] font-semibold uppercase">PUISI</span>
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

                @if ($puisiList->count() > 5)
                    <div class="col-start-5 col-span-full flex justify-end items-end w-full">
                        <a href="{{ url('/karya/puisi') }}" class="text-red-700 font-semibold text-sm">Selengkapnya
                            >></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Bagian Pantun -->
    <section class="mt-12">
        <div class="max-w-7xl mx-auto px-5">
            <div class="flex flex-col mb-6">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                        style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Pantun
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                @foreach ($pantunList as $pantun)
                    <div class="flex flex-col items-start">
                        <a href="{{ route('karya.pantun.read', ['k' => $pantun->id]) }}">
                            <img src="data:image/jpeg;base64,{{ $pantun->media }}" alt="{{ $pantun->judul }}"
                                class="w-full h-64 object-cover rounded-lg shadow-md" />
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

                @if ($pantunList->count() > 5)
                    <div class="col-start-5 col-span-full flex justify-end items-end w-full">
                        <a href="{{ url('/karya/pantun') }}" class="text-red-700 font-semibold text-sm">Selengkapnya
                            >></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Bagian Syair -->
    <section class="mt-12">
        <div class="max-w-7xl mx-auto px-5">
            <div class="flex flex-col mb-6">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                        style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Syair
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                @foreach ($syairList as $syair)
                    <div class="flex flex-col items-start">
                        <a href="{{ route('karya.syair.read', ['k' => $syair->id]) }}">
                            <img src="data:image/jpeg;base64,{{ $syair->media }}" alt="{{ $syair->judul }}"
                                class="w-full h-64 object-cover rounded-lg shadow-md" />
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

                @if ($syairList->count() > 5)
                    <div class="col-start-5 col-span-full flex justify-end items-end w-full">
                        <a href="{{ url('/karya/syair') }}" class="text-red-700 font-semibold text-sm">Selengkapnya
                            >></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Bagian Fotografi -->
    <section class="mt-12">
        <div class="max-w-7xl mx-auto px-5">
            <div class="flex flex-col mb-6">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                        style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Fotografi
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>

            <div class="grid grid-cols-12 gap-4">
                @foreach ($fotografiList as $index => $fotografi)
                    @php
                        $isHighlight = $index <= 2;
                    @endphp

                    @if ($isHighlight)
                        <div class="col-span-12 md:col-span-4 relative">
                            <a href="{{ route('karya.fotografi.read', ['k' => $fotografi->id]) }}"
                                class="block relative">
                                <img src="data:image/jpeg;base64,{{ $fotografi->media }}" alt="{{ $fotografi->judul }}"
                                    class="w-full h-80 object-cover rounded-lg aspect-[4/3]" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#990505] via-transparent to-transparent opacity-80 rounded-lg">
                                </div>
                                <div class="absolute bottom-0 p-4 text-white">
                                    <div class="flex items-center gap-2 mb-1 text-xs font-semibold uppercase">
                                        FOTOGRAFI
                                        <div class="w-[2px] h-3.5 bg-white"></div>
                                        <span>{{ \Carbon\Carbon::parse($fotografi->release_date)->translatedFormat('d M Y') }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold leading-snug">
                                        {{ $fotografi->judul }}
                                    </h3>
                                    <div class="text-xs italic font-medium">
                                        Oleh: {{ $fotografi->creator ?? '-' }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="col-span-6 md:col-span-4 lg:col-span-2 flex flex-col items-start">
                            <a href="{{ route('karya.fotografi.read', ['k' => $fotografi->id]) }}">
                                <img src="data:image/jpeg;base64,{{ $fotografi->media }}" alt="{{ $fotografi->judul }}"
                                    class="w-full h-40 object-cover rounded-lg shadow-md aspect-[4/3]" />
                            </a>

                            <div class="mt-2 text-xs text-gray-700 w-full">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="text-[#990505] font-semibold uppercase">FOTOGRAFI</span>
                                    <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                                    <span>{{ \Carbon\Carbon::parse($fotografi->release_date)->translatedFormat('d M Y') }}</span>
                                </div>
                                <h3 class="text-sm font-semibold leading-tight mb-1">{{ $fotografi->judul }}</h3>
                                <div class="text-xs italic font-medium text-gray-800">
                                    <span>Oleh: {{ $fotografi->creator ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach


                @if ($totalFotografiCount > 9)
                    <div class="col-span-12 flex justify-end items-end w-full">
                        <a href="{{ url('/karya/fotografi') }}" class="text-red-700 font-semibold text-sm">Selengkapnya
                            >></a>
                    </div>
                @endif
            </div>
        </div>
    </section>


    <!-- Bagian Desain Grafis -->
    <section class="mt-12 mb-12">
        <div class="max-w-7xl mx-auto px-5">
            <div class="flex flex-col mb-6">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605] flex items-center justify-center text-center"
                        style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                        Desain Grafis
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
            </div>

            <div class="grid grid-cols-12 gap-4">
                @foreach ($desainGrafisList as $index => $desainGrafis)
                    @php
                        $isHighlight = $index <= 2;
                    @endphp

                    @if ($isHighlight)
                        <div class="col-span-12 md:col-span-4 relative">
                            <a href="{{ route('karya.desain-grafis.read', ['k' => $desainGrafis->id]) }}"
                                class="block relative">
                                <img src="data:image/jpeg;base64,{{ $desainGrafis->media }}"
                                    alt="{{ $desainGrafis->judul }}"
                                    class="w-full h-80 object-cover rounded-lg aspect-[4/3]" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#990505] via-transparent to-transparent opacity-80 rounded-lg">
                                </div>
                                <div class="absolute bottom-0 p-4 text-white">
                                    <div class="flex items-center gap-2 mb-1 text-xs font-semibold uppercase">
                                        DESAIN GRAFIS
                                        <div class="w-[2px] h-3.5 bg-white"></div>
                                        <span>{{ \Carbon\Carbon::parse($desainGrafis->release_date)->translatedFormat('d M Y') }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold leading-snug">
                                        {{ $desainGrafis->judul }}
                                    </h3>
                                    <div class="text-xs italic font-medium">
                                        Oleh: {{ $desainGrafis->creator ?? '-' }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="col-span-6 md:col-span-4 lg:col-span-2 flex flex-col items-start">
                            <a href="{{ route('karya.desain-grafis.read', ['k' => $desainGrafis->id]) }}">
                                <img src="data:image/jpeg;base64,{{ $desainGrafis->media }}"
                                    alt="{{ $desainGrafis->judul }}"
                                    class="w-full h-40 object-cover rounded-lg shadow-md aspect-[4/3]" />
                            </a>

                            <div class="mt-2 text-xs text-gray-700 w-full">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="text-[#990505] font-semibold uppercase">DESAIN GRAFIS</span>
                                    <div class="w-[2px] h-3.5 bg-[#990505]"></div>
                                    <span>{{ \Carbon\Carbon::parse($desainGrafis->release_date)->translatedFormat('d M Y') }}</span>
                                </div>
                                <h3 class="text-sm font-semibold leading-tight mb-1">{{ $desainGrafis->judul }}</h3>
                                <div class="text-xs italic font-medium text-gray-800">
                                    <span>Oleh: {{ $desainGrafis->creator ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if ($totalDesainGrafisCount > 9)
                    <div class="col-span-12 flex justify-end items-end w-full">
                        <a href="{{ url('/karya/desain-grafis') }}"
                            class="text-red-700 font-semibold text-sm">Selengkapnya >></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Tambahkan Library PDF.js sekali di akhir halaman -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- SwiperJS Script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            loop: true,
            spaceBetween: 10,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endsection
