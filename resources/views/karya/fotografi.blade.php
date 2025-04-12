@extends('layouts.app')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 sm:px-6 py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- Karya Kami --}}
        <div class="md:col-span-2">
            <h2 class="text-2xl font-bold mb-0">Karya Kami</h2>
            <p class="text-sm text-[#A8A8A8] mb-1">Kumpulan Karya Karya Terbaik</p>
            <div class="w-full h-[2px] bg-[#A8A8A8] mb-4"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($karya as $item)
                <div class="flex gap-4">
                    <img src="data:image/jpeg;base64,{{ $item->media }}" alt="{{ $item->judul }}"
                        class="w-[200px] h-[160px] object-fill rounded-md flex-shrink-0" />
                    <div class="flex flex-col justify-between w-full">
                        <div class="space-y-[2px]">
                            <p class="text-sm">
                                <span class="text-[#990505] font-bold">{{ ucfirst($item->kategori) }}</span> |
                                <span class="text-[#A8A8A8]">
                                    {{ \Carbon\Carbon::parse($item->release_date)->format('d M Y') }}
                                </span>
                            </p>
                            <h3 class="text-base font-bold">{{ $item->judul }}</h3>
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-[#ABABAB] m-0">{{ $item->user->nama_lengkap ?? '-' }}</p>
                                <div class="flex items-center gap-4 text-[#ABABAB] text-sm">
                                    <div class="flex items-center gap-1">
                                        <i class="fa-solid fa-thumbs-up"></i>
                                        <span>107</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <i class="fa-solid fa-share-nodes"></i>
                                        <span>Share</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-[#5773FF]">Lihat Gambar</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Terbaru dan Rekomendasi Hari Ini --}}
        <div class="md:col-span-1">

            {{-- Terbaru --}}
            <div class="flex flex-col mb-8">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]"
                        style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                        Terbaru
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
                <div class="flex flex-col gap-4 mt-4">
                    @foreach ($terbaru as $item)
                    <div class="relative w-full h-[220px] rounded-lg overflow-hidden shadow-md">
                        <img src="data:image/jpeg;base64,{{ $item->media }}" alt="{{ $item->judul }}"
                            class="w-full h-full object-fill" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#990505] to-transparent opacity-90"></div>
                        <div class="absolute bottom-0 left-0 right-0 px-4 py-2 text-white text-sm font-semibold z-10">
                            {{ $item->judul }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Rekomendasi Hari Ini --}}
            <div class="mt-4">
                <div class="flex items-center">
                    <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                    <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]"
                        style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                        Rekomendasi Hari Ini
                    </h2>
                </div>
                <div class="w-full h-[2px] bg-gray-300"></div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    @foreach ($rekomendasi as $item)
                    <div class="flex flex-col items-start">
                        <img src="data:image/jpeg;base64,{{ $item->media }}" alt="{{ $item->judul }}"
                            class="w-full h-[110px] object-fill rounded-md shadow-md" />
                        <h3 class="text-sm font-bold mt-1">{{ $item->judul }}</h3>
                        <div class="flex items-center justify-between w-full text-[#ABABAB] text-xs mt-1">
                            <p>{{ $item->user->nama_lengkap ?? '-' }}</p>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                    <span>107</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <i class="fa-solid fa-share-nodes"></i>
                                    <span>Share</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
