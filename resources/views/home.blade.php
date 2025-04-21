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

@endsection
