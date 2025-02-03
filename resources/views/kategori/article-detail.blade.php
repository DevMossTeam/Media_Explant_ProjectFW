@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white shadow rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $article->judul }}</h1>
            <p class="text-gray-600 text-sm mb-4">Anonym - {{ \Carbon\Carbon::parse($article->tanggal_diterbitkan)->format('d M Y') }} | Kategori: {{ $article->kategori }}</p>
            <div class="content text-gray-800 text-justify">
                {!! $article->konten_artikel !!}
            </div>
        </article>
    </div>
</main>
@endsection
