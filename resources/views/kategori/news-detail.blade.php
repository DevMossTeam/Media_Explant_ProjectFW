@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">

            <!-- Judul Berita -->
            <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">{{ $news->judul }}</h1>
            <p class="text-gray-600 text-sm mb-4 text-center">
                Anonym - {{ \Carbon\Carbon::parse($news->tanggal_diterbitkan)->format('d M Y') }} |
                Kategori: {{ $news->kategori }}
            </p>

            <!-- Gambar utama hanya jika tidak ada gambar di dalam konten berita -->
            @if (!str_contains($news->konten_berita, '<img'))
                <div class="flex justify-center mb-6">
                    <img src="{{ $news->first_image }}" alt="Gambar Ilustrasi"
                         class="rounded-lg shadow-md max-w-full h-auto pointer-events-none select-none">
                </div>
            @endif

            <!-- Konten Berita dengan gambar diposisikan di tengah & tidak bisa diklik -->
            <div class="content text-gray-800 text-justify leading-relaxed">
                {!! preg_replace([
                    '/<a[^>]*>\s*(<img[^>]*>)\s*<\/a>/i', // Menghapus <a> di sekitar <img>
                    '/<img(.*?)>/i' // Memodifikasi <img> agar tidak bisa diklik dan di tengah
                ], [
                    '$1', // Menghilangkan tag <a> di sekitar gambar
                    '<img$1 class="mx-auto pointer-events-none select-none">' // Tambahkan class untuk gambar
                ], $news->konten_berita) !!}
            </div>
        </div>
    </div>
</main>
@endsection
