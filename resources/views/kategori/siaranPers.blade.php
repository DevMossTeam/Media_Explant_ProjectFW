@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Siaran Pers</h1>

        @if ($articles->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white shadow rounded-lg overflow-hidden">
                    <a href="{{ route('siaran-pers.detail', ['a' => $articles->first()->id]) }}">
                        <img src="{{ $articles->first()->first_image }}" alt="{{ $articles->first()->judul }}" class="w-full h-60 object-cover">
                    </a>
                    <div class="p-4">
                        <a href="{{ route('siaran-pers.detail', ['a' => $articles->first()->id]) }}">
                            <h2 class="text-xl font-bold">{{ $articles->first()->judul }}</h2>
                        </a>
                        <p class="text-gray-600 mt-2">Anonym - {{ \Carbon\Carbon::parse($articles->first()->tanggal_diterbitkan)->format('d M Y') }}</p>
                        <p class="text-gray-800 mt-2 text-justify">{{ Str::limit(strip_tags($articles->first()->konten_artikel), 150) }}</p>
                        <a href="{{ route('siaran-pers.detail', ['a' => $articles->first()->id]) }}" class="text-red-600 font-bold mt-4 inline-block">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($articles->skip(1)->take(4) as $article)
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <a href="{{ route('siaran-pers.detail', ['a' => $article->id]) }}">
                                <img src="{{ $article->first_image }}" alt="{{ $article->judul }}" class="w-full h-36 object-cover">
                            </a>
                            <div class="p-3">
                                <a href="{{ route('siaran-pers.detail', ['a' => $article->id]) }}">
                                    <h3 class="text-sm font-bold">{{ $article->judul }}</h3>
                                </a>
                                <p class="text-xs text-gray-600">Anonym - {{ \Carbon\Carbon::parse($article->tanggal_diterbitkan)->format('d M Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
