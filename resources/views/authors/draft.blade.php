@extends('layouts.app')

@section('content')
    <main class="py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-6">Daftar Draft</h2>

            @if (!isset($drafts))
                <p class="text-red-600">Error: Variabel <strong>$drafts</strong> tidak tersedia.</p>
            @elseif ($drafts->isEmpty())
                <p class="text-gray-600">Belum ada draft berita.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($drafts as $draft)
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            {{-- Ambil gambar pertama dari konten_berita --}}
                            @php
                                preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $draft->konten_berita, $matches);
                                $firstImage = $matches[1] ?? asset('images/no-image.jpg');
                            @endphp
                            <img src="{{ $firstImage }}" alt="{{ $draft->judul }}" class="w-full h-48 object-cover">

                            <div class="p-4">
                                <h3 class="text-lg font-bold">
                                    {{ $draft->judul }}
                                </h3>
                                <p class="text-sm text-gray-600 mt-2">
                                    Dipublikasikan pada: {{ \Carbon\Carbon::parse($draft->tanggal_diterbitkan)->format('d M Y') }}
                                </p>
                                <p class="text-sm text-blue-600 font-semibold mt-1">
                                    Status: {{ ucfirst($draft->visibilitas) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $drafts->links() }}
                </div>
            @endif
        </div>
    </main>
@endsection
