@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Artikel</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Contoh artikel -->
        @for ($i = 1; $i <= 6; $i++)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Judul Artikel {{ $i }}</h2>
                <p class="text-gray-600 text-sm">Ringkasan singkat dari artikel {{ $i }}...</p>
                <div class="mt-4">
                    <a href="#" class="text-red-500 hover:underline">Baca Selengkapnya</a>
                </div>
            </div>
        @endfor

        <!-- Pesan jika tidak ada artikel -->
        @if (false)
            <p class="text-gray-600">Tidak ada artikel yang tersedia.</p>
        @endif
    </div>
</div>
@endsection
