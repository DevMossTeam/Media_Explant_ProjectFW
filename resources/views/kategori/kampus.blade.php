@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="max-w-[1600px] mx-auto px-12 md:px-24 lg:px-32 grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- TERBARU --}}
        <div class="md:col-span-1">
            <div class="flex flex-col mb-8">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]" style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Terbaru
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300 mb-4"></div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                @foreach ($terbaru as $item)
                    <div>
                        <a href="{{ route('kampus.detail', ['a' => $item->id]) }}">
                            <img src="{{ $item->first_image }}" alt="{{ $item->judul }}" class="w-full h-28 object-cover mb-1 rounded">
                        </a>
                        <a href="{{ route('kampus.detail', ['a' => $item->id]) }}">
                            <h3 class="text-[13px] font-semibold leading-tight">{{ Str::limit($item->judul, 40) }}</h3>
                        </a>
                        <div class="flex items-center justify-start gap-3 mt-1 text-[11px] text-[#ABABAB] font-semibold">
                            <span>{{ $item->user->nama_lengkap ?? '-' }}</span>
                            <div class="flex gap-2 text-xs">
                                <div class="flex items-center gap-1">
                                    <i class="fa-regular fa-thumbs-up"></i><span>107</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <i class="fa-solid fa-share-nodes"></i><span>Share</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Rekomendasi --}}
            <div class="flex flex-col mt-8 mb-4">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]" style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Rekomendasi Berita
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300 mb-4"></div>
            </div>

            <div class="flex flex-col gap-4">
                @foreach ($rekomendasi as $item)
                    <div>
                        <a href="{{ route('kampus.detail', ['a' => $item->id]) }}">
                            <h3 class="text-[15px] font-semibold leading-tight">{{ Str::limit($item->judul, 50) }}</h3>
                        </a>
                        <div class="flex items-center justify-start gap-3 mt-1 text-[11px] text-[#ABABAB] font-semibold">
                            <span>{{ $item->user->nama_lengkap ?? '-' }}</span>
                            <div class="flex gap-2 text-xs">
                                <div class="flex items-center gap-1">
                                    <i class="fa-regular fa-thumbs-up"></i><span>107</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <i class="fa-solid fa-share-nodes"></i><span>Share</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- TERPOPULER --}}
        <div class="md:col-span-2 -mt-2">
            <h2 class="text-2xl font-bold mb-1">Berita</h2>
            <p class="text-sm text-gray-500 mb-2">Kumpulan Berita Terbaik</p>
            <div class="w-full h-[2px] bg-[#A8A8A8] mb-4"></div>

            <div class="flex flex-col gap-6">
                @foreach ($terpopuler as $item)
                    <div class="flex gap-4">
                        <a href="{{ route('kampus.detail', ['a' => $item->id]) }}">
                            <img src="{{ $item->first_image }}" alt="{{ $item->judul }}" class="w-52 h-32 object-cover rounded">
                        </a>
                        <div class="flex-1">
                            <div class="flex items-center text-xs font-semibold mb-1">
                                <span class="text-[#990505]">{{ strtoupper($item->kategori) }}</span>
                                <span class="mx-2 text-[#990505]">|</span>
                                <span class="text-[#A8A8A8]">{{ \Carbon\Carbon::parse($item->tanggal_diterbitkan)->format('d M Y') }}</span>
                            </div>
                            <a href="{{ route('kampus.detail', ['a' => $item->id]) }}">
                                <h3 class="text-lg font-bold mb-1">{{ $item->judul }}</h3>
                            </a>
                            <p class="text-sm text-gray-600 mb-2">{{ Str::limit(strip_tags($item->konten_berita), 150) }}</p>
                            <div class="flex items-center gap-3 text-[13px] text-[#ABABAB] font-semibold">
                                <span>{{ $item->user->nama_lengkap ?? '-' }}</span>
                                <div class="flex gap-2 text-xs">
                                    <div class="flex items-center gap-1">
                                        <i class="fa-regular fa-thumbs-up"></i><span>107</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <i class="fa-solid fa-share-nodes"></i><span>Share</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection
