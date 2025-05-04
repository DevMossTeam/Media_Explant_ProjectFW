@extends('layouts.app')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 sm:px-6 py-10">
    <h1 class="text-2xl font-semibold mb-1">Publikasi Karya</h1>
    <p class="text-sm text-gray-500 mb-4">Kumpulan Karya</p>

    <div class="flex justify-between items-center mb-4">
        <input type="text" placeholder="Search" class="border px-3 py-2 rounded-md w-1/3">
        <button class="flex items-center space-x-1 bg-red-600 text-white px-3 py-2 rounded-md">
            <span>A - Z Group</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>

    <div class="overflow-y-scroll h-[75vh] pr-2 space-y-4">
        @forelse ($berita as $item)
        <div class="flex items-start space-x-4 bg-white p-4 rounded shadow-sm">
            <img src="{{ $item['thumbnail'] ?? asset('images/default-thumbnail.jpg') }}" alt="Thumbnail" class="w-28 h-20 object-cover rounded">
            <div class="flex-1">
                <p class="text-red-600 text-xs font-semibold">{{ strtoupper($item['kategori']) }} | Dipublikasikan {{ $item['tanggal'] }}</p>
                <p class="font-medium">{{ $item['judul'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Diperbarui {{ $item['published_ago'] }}</p>
            </div>
            <div class="relative">
                <button class="text-gray-600 hover:text-black">&#8942;</button>
                <div class="absolute right-0 mt-1 bg-white border rounded shadow w-24 text-sm hidden group-hover:block">
                    <a href="#" class="block px-3 py-2 hover:bg-gray-100">Edit</a>
                    <a href="#" class="block px-3 py-2 hover:bg-gray-100 text-red-500">Hapus</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500">Tidak ada publikasi yang tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
