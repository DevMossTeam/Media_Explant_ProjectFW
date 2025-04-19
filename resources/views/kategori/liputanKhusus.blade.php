@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Liputan Khusus</h1>

        @if ($news->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white shadow rounded-lg overflow-hidden">
                    <a href="{{ route('liputan-khusus.detail', ['a' => $news->first()->id]) }}">
                        <img src="{{ $news->first()->first_image }}" alt="{{ $news->first()->judul }}" class="w-full h-60 object-cover">
                    </a>
                    <div class="p-4">
                        <a href="{{ route('liputan-khusus.detail', ['a' => $news->first()->id]) }}">
                            <h2 class="text-xl font-bold">{{ $news->first()->judul }}</h2>
                        </a>
                        <p class="text-gray-600 mt-2">Anonym - {{ \Carbon\Carbon::parse($news->first()->tanggal_diterbitkan)->format('d M Y') }}</p>
                        <p class="text-gray-800 mt-2 text-justify">{{ Str::limit(strip_tags($news->first()->konten_artikel), 150) }}</p>
                        <a href="{{ route('liputan-khusus.detail', ['a' => $news->first()->id]) }}" class="text-red-600 font-bold mt-4 inline-block">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($news->skip(1)->take(4) as $news)
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <a href="{{ route('liputan-khusus.detail', ['a' => $news->id]) }}">
                                <img src="{{ $news->first_image }}" alt="{{ $news->judul }}" class="w-full h-36 object-cover">
                            </a>
                            <div class="p-3">
                                <a href="{{ route('liputan-khusus.detail', ['a' => $news->id]) }}">
                                    <h3 class="text-sm font-bold">{{ $news->judul }}</h3>
                                </a>
                                <p class="text-xs text-gray-600">Anonym - {{ \Carbon\Carbon::parse($news->tanggal_diterbitkan)->format('d M Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
