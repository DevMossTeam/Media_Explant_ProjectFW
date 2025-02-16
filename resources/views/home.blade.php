@extends('layouts.app')

@section('content')
    <main class="py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-6">Beranda</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($news as $item)
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <a href="{{ $item->article_url }}">
                            <img src="{{ $item->first_image }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-bold">
                                <a href="{{ $item->article_url }}" class="hover:text-red-600">
                                    {{ $item->judul }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                {{ \Carbon\Carbon::parse($item->tanggal_diterbitkan)->format('d M Y') }}
                            </p>
                            <p class="text-gray-800 mt-2">{{ $item->excerpt }}</p>
                            <a href="{{ $item->article_url }}" class="text-red-600 font-bold mt-2 inline-block">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                @endforeach
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $news->links() }}
                </div>
            </div>
    </main>
@endsection
