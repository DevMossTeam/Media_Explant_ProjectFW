@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Draf Artikel</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Contoh artikel draf -->
        @for ($i = 1; $i <= 3; $i++)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Judul Draf {{ $i }}</h2>
                <p class="text-gray-600 text-sm">Ringkasan singkat dari draf artikel {{ $i }}...</p>
                <div class="mt-4 flex justify-between">
                    <a href="#" class="text-blue-500 hover:underline">Edit</a>
                    <a href="#" class="text-red-500 hover:underline">Hapus</a>
                </div>
            </div>
        @endfor

        <!-- Pesan jika tidak ada draf -->
        @if (false)
            <p class="text-gray-600">Belum ada draf artikel.</p>
        @endif
    </div>
</div>
@endsection
