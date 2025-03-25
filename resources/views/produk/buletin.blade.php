@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl">
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <h2 class="text-3xl font-semibold">Produk Kami</h2>
            <p class="text-gray-600 mb-2 text-lg">Kumpulan Produk Terbaik</p>
            <div class="w-full h-[2px] bg-gray-300"></div>

            @if (!isset($buletins) || $buletins->isEmpty())
                <p class="text-gray-500">Tidak ada buletin yang tersedia.</p>
            @else
                <div class="grid grid-cols-1 gap-8 mt-4">
                    @foreach ($buletins as $buletin)
                        <div class="relative rounded-lg overflow-hidden shadow-md">
                            <img src="{{ asset('storage/' . $buletin->media) }}" alt="Buletin" class="w-full h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#990505] to-transparent opacity-90"></div>
                            <div class="absolute bottom-0 left-0 p-4 text-white w-full">
                                <p class="text-sm font-medium flex items-center gap-2">
                                    <span>BULETIN</span> | <span>{{ $buletin->formatted_release_date }}</span>
                                </p>
                                <h2 class="text-lg font-semibold mt-1">{{ $buletin->judul }}</h2>
                                <p class="text-sm mt-1 line-clamp-2">{{ $buletin->deskripsi }}</p>
                            </div>
                            <div class="absolute bottom-4 right-4">
                                <img src="https://img.icons8.com/ios-filled/50/ffffff/pdf.png" alt="PDF Icon" class="w-10 h-10">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>

@endsection
