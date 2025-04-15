@extends('layouts.app')

@section('content')
    <div class="max-w-[1320px] mx-auto px-4 sm:px-6 py-10">

        {{-- Label SYAIR --}}
        <div class="flex flex-col mb-8">
            <div class="flex items-center">
                <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]"
                    style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                    SYAIR
                </h2>
            </div>
            <div class="w-full h-[2px] bg-gray-300 mb-4"></div>
        </div>

        {{-- Judul --}}
        <h1 class="text-3xl font-bold mb-2">{{ $karya->judul }}</h1>

        {{-- Info Penulis & Waktu --}}
        <div class="flex items-center text-sm text-[#A8A8A8] mb-4">
            <span class="mr-2">Oleh : {{ $karya->user->nama_lengkap ?? '-' }}</span> |
            <span class="ml-2">{{ \Carbon\Carbon::parse($karya->release_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($karya->release_date)->format('H.i') }} WIB</span>
            <div class="ml-auto -mt-4">
                <button class="flex items-center gap-2 text-gray-400 hover:text-gray-800" title="Simpan dan baca nanti">
                    <span class="text-sm">Simpan dan baca nanti</span>
                    <i class="far fa-bookmark text-xl"></i>
                </button>
            </div>
        </div>

        {{-- Konten --}}
        <div class="flex flex-col lg:flex-row gap-10">
            {{-- Deskripsi --}}
            <div class="lg:w-2/3 text-[15px] leading-relaxed text-justify">
                {!! nl2br(e($karya->deskripsi)) !!}
            </div>

            {{-- Gambar --}}
            <div class="lg:w-1/3">
                <div class="relative mt-[-10px]">
                    <img src="data:image/jpeg;base64,{{ $karya->media }}"
                        alt="{{ $karya->judul }}" class="w-full rounded-lg shadow-md" />
                </div>
                <div class="mt-2 text-sm text-[#ABABAB] italic text-center">(Karya oleh {{ $karya->creator ?? 'Unknown' }})</div>
            </div>
        </div>

        {{-- Tanggapan --}}
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

        {{-- Komentar --}}
        <div class="mt-6">
            <form action="#" method="POST">
                @csrf
                <div class="relative w-full">
                    <input type="text" name="komentar" placeholder="Tulis komentarmu disini"
                        class="w-full border border-[#9A0605] rounded-full pr-12 pl-4 py-2 text-sm focus:outline-none" />
                    <button type="submit"
                        class="absolute right-0 top-0 bottom-0 w-10 flex items-center justify-center bg-[#9A0605] rounded-full rounded-l-none text-white hover:bg-red-800">
                        <i class="fas fa-paper-plane text-sm"></i>
                    </button>
                </div>
            </form>
            <div class="mt-3 border border-gray-200 rounded-lg p-4 bg-gray-50 text-sm text-gray-500 text-center">
                Belum Ada Komentar
            </div>
        </div>

        {{-- Rekomendasi Hari Ini --}}
        <div class="mt-10 flex flex-col mb-8">
            <div class="flex items-center">
                <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]"
                    style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                    Rekomendasi Hari ini
                </h2>
            </div>
            <div class="w-full h-[2px] bg-gray-300 mb-4"></div>
        </div>

        {{-- Grid Rekomendasi --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($rekomendasi as $item)
                <div class="flex flex-col">
                    <a href="{{ route('karya.syair.read', ['k' => $item->id]) }}">
                        <img src="data:image/jpeg;base64,{{ $item->media }}" alt="{{ $item->judul }}"
                            class="w-full h-[240px] object-cover rounded-lg shadow-md" />
                    </a>
                    <p class="mt-2 text-sm">
                        <span class="text-[#990505] font-bold">
                            {{ strtoupper(str_replace('_', ' ', $item->kategori)) }}
                        </span>
                        <span class="text-[#990505] font-bold"> | </span>
                        <span class="text-[#A8A8A8]">
                            {{ \Carbon\Carbon::parse($item->release_date)->format('d M Y') }}
                        </span>
                    </p>
                    <a href="{{ route('karya.syair.read', ['k' => $item->id]) }}">
                        <h3 class="text-base font-bold mt-1">"{{ $item->judul }}"</h3>
                    </a>
                    <p class="text-sm text-gray-700 mb-2">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 80) }}
                    </p>
                    <div class="flex justify-between items-center text-sm text-[#ABABAB] font-semibold">
                        <span>{{ $item->user->nama_lengkap ?? '-' }}</span>
                        <div class="flex gap-3 text-xs">
                            <div class="flex items-center gap-1">
                                <i class="fa-regular fa-thumbs-up"></i>
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
@endsection
