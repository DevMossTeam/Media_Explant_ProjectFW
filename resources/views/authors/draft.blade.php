{{-- draft.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-[1320px] mx-auto px-4 sm:px-6 py-10">
    <h1 class="text-2xl font-semibold mb-1">Draft Karya</h1>
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
        @for($i = 0; $i < 10; $i++)
        {{-- Draft Kesenian --}}
        <div class="flex items-start space-x-4 bg-white p-4 rounded shadow-sm">
            <img src="{{ asset('images/saman.jpg') }}" alt="Tari Saman" class="w-28 h-20 object-cover rounded">
            <div class="flex-1">
                <p class="text-red-600 text-xs font-semibold">KESENIAN | Dibuat 13 Feb 2025</p>
                <p class="font-medium">Tari Saman: Memahami Makna, Sejarah, Fungsi, dan Pola Lantai</p>
                <p class="text-xs text-gray-500 mt-1">Diperbarui 2 jam yang lalu</p>
            </div>
            <div class="relative">
                <button class="text-gray-600 hover:text-black">&#8942;</button>
                {{-- Simulasi dropdown menu --}}
                <div class="absolute right-0 mt-1 bg-white border rounded shadow w-24 text-sm hidden group-hover:block">
                    <a href="#" class="block px-3 py-2 hover:bg-gray-100">Edit</a>
                    <a href="#" class="block px-3 py-2 hover:bg-gray-100 text-red-500">Hapus</a>
                </div>
            </div>
        </div>

        {{-- Draft Majalah --}}
        <div class="flex items-start space-x-4 bg-white p-4 rounded shadow-sm">
            <img src="{{ asset('images/majalah.jpg') }}" alt="Majalah Online" class="w-28 h-20 object-cover rounded">
            <div class="flex-1">
                <p class="text-pink-600 text-xs font-semibold">MAJALAH | Dibuat 07 Dec 2024</p>
                <p class="font-medium">Majalah Himpunan Mahasiswa Teknik ...</p>
                <p class="text-xs text-gray-500 mt-1">Diperbarui 2 jam yang lalu</p>
            </div>
            <div class="relative">
                <button class="text-gray-600 hover:text-black">&#8942;</button>
                <div class="absolute right-0 mt-1 bg-white border rounded shadow w-24 text-sm hidden group-hover:block">
                    <a href="#" class="block px-3 py-2 hover:bg-gray-100">Edit</a>
                    <a href="#" class="block px-3 py-2 hover:bg-gray-100 text-red-500">Hapus</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
