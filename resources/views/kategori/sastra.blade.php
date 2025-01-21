@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Sastra</h1>

        <!-- Bagian Berita Utama -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Berita Utama Besar -->
            <div class="lg:col-span-2 bg-white shadow rounded-lg overflow-hidden">
                <a href="{{ route('article.detail', ['id' => 1]) }}">
                    <img src="https://via.placeholder.com/800x400" alt="Berita Utama" class="w-full h-60 object-cover">
                </a>
                <div class="p-4">
                    <a href="{{ route('article.detail', ['id' => 1]) }}">
                        <h2 class="text-xl font-bold">HRW: Student Media at Risk</h2>
                    </a>
                    <p class="text-gray-600 mt-2">Admin Persma - 22 Mei 2023</p>
                    <p class="text-gray-800 mt-2 text-justify">College Journalists Face Intimidation, Censorship, Newsroom Closures...</p>
                    <a href="{{ route('article.detail', ['id' => 1]) }}" class="text-red-600 font-bold mt-4 inline-block">Baca Selengkapnya</a>
                </div>
            </div>

            <!-- Berita Utama Kecil -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <a href="{{ route('article.detail', ['id' => $i + 1]) }}">
                            <img src="https://via.placeholder.com/400x200" alt="Berita {{ $i }}" class="w-full h-36 object-cover">
                        </a>
                        <div class="p-3">
                            <a href="{{ route('article.detail', ['id' => $i + 1]) }}">
                                <h3 class="text-sm font-bold">Judul Berita {{ $i }}</h3>
                            </a>
                            <p class="text-xs text-gray-600">Anonym - {{ date('d M Y') }}</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Bagian Berita Lainnya -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Berita Lainnya</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for ($i = 1; $i <= 12; $i++)
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <a href="{{ route('article.detail', ['id' => $i + 5]) }}">
                            <img src="https://via.placeholder.com/400x200" alt="Berita Lainnya {{ $i }}" class="w-full h-36 object-cover">
                        </a>
                        <div class="p-3">
                            <a href="{{ route('article.detail', ['id' => $i + 5]) }}">
                                <h3 class="text-sm font-bold">Judul Berita Lainnya {{ $i }}</h3>
                            </a>
                            <p class="text-xs text-gray-600">Anonym - {{ date('d M Y') }}</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 text-center">
            <nav>
                <ul class="inline-flex items-center space-x-2">
                    <li><a href="#" class="px-3 py-1 bg-red-600 text-white rounded">1</a></li>
                    <li><a href="#" class="px-3 py-1 bg-gray-200 text-gray-700 rounded">2</a></li>
                    <li><a href="#" class="px-3 py-1 bg-gray-200 text-gray-700 rounded">3</a></li>
                </ul>
            </nav>
        </div>
    </div>
</main>
@endsection
