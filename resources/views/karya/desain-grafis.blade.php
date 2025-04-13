@extends('layouts.app')

@section('content')
    <div class="max-w-[1320px] mx-auto px-4 sm:px-6 py-10">
        <h2 class="text-2xl font-bold mb-1">Karya Kami</h2>
        <p class="text-sm text-gray-500 mb-2">Kumpulan Karya Karya Terbaik</p>
        <div class="w-full h-[2px] bg-[#A8A8A8] mb-4"></div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($karya as $item)
                <div class="flex flex-col">
                    <img src="data:image/jpeg;base64,{{ $item->media }}" alt="{{ $item->judul }}"
                        class="w-full h-[240px] object-cover rounded-lg shadow-md" />
                    <p class="mt-2 text-sm">
                        <span class="text-[#990505] font-bold">
                            {{ strtoupper(str_replace('_', ' ', $item->kategori)) }}
                        </span>
                        <span class="text-[#990505] font-bold"> | </span>
                        <span class="text-[#A8A8A8]">
                            {{ \Carbon\Carbon::parse($item->release_date)->format('d M Y') }}
                        </span>
                    </p>
                    <h3 class="text-base font-bold mt-1">"{{ $item->judul }}"</h3>
                    <p class="text-sm text-gray-700 mb-2">
                        {{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}
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

        <div class="mt-6">
            {{ $karya->links() }}
        </div>
    </div>
@endsection
