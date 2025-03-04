@extends('layouts.app')

@section('content')
    <main class="py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8 max-w-7xl mx-auto">

            <!-- Konten Berita -->
            <div class="w-full md:w-2/3 lg:w-3/4">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 text-center">{{ $news->judul }}</h1>

                <p class="text-gray-600 text-xs md:text-sm mb-4 text-center">
                    {{ $news->user->nama_lengkap ?? 'Tidak Diketahui' }} -
                    {{ \Carbon\Carbon::parse($news->tanggal_diterbitkan)->format('d M Y') }} |
                    Kategori: {{ $news->kategori }}
                </p>

                @if (!str_contains($news->konten_berita, '<img'))
                    <div class="flex justify-center mb-6">
                        <img src="{{ $news->first_image }}" alt="Gambar Ilustrasi"
                            class="rounded-lg shadow-md max-w-full h-auto pointer-events-none select-none">
                    </div>
                @endif

                {!! preg_replace([
        '/<a[^>]*>\s*(<img[^>]*>)\s*<\/a>/i',
        '/<img(.*?)>/i'
    ], [
        '$1',
        '<img$1 class="mx-auto pointer-events-none select-none">'
    ], $news->konten_berita) !!}

                <div class="flex flex-wrap justify-between items-center mt-6 border-t pt-4">
                    <div class="flex flex-wrap space-x-2">
                        <button id="likeButton" class="flex items-center bg-gray-100 px-3 py-2 rounded-lg text-gray-600 hover:bg-blue-100">
                            <i class="fas fa-thumbs-up mr-2"></i> <span id="likeCount">0</span>
                        </button>
                        <button id="dislikeButton" class="flex items-center bg-gray-100 px-3 py-2 rounded-lg text-gray-600 hover:bg-red-100">
                            <i class="fas fa-thumbs-down mr-2"></i> <span id="dislikeCount">0</span>
                        </button>
                        <button class="flex items-center bg-gray-100 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-200">
                            <i class="fas fa-share mr-2"></i>
                        </button>
                        <button class="flex items-center bg-gray-100 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-200">
                            <i class="fas fa-bookmark mr-2"></i>
                        </button>
                        <button class="flex items-center bg-gray-100 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-200">
                            <i class="fas fa-flag mr-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Area Komentar -->
                <h2 class="text-lg md:text-xl font-bold text-gray-800 mt-8 mb-4">Komentar (0)</h2>
                <div class="flex items-center border rounded-lg p-2 bg-gray-100">
                    <input type="text" class="w-full p-2 rounded-lg border-none outline-none bg-gray-100"
                        placeholder="Tulis komentarmu disini">
                    <button
                        class="ml-2 bg-red-600 hover:bg-red-700 text-white p-3 rounded-full shadow-md transition-all duration-200 ease-in-out flex items-center justify-center">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
                <div class="mt-4 p-6 bg-gray-50 border rounded-lg text-center text-gray-500">
                    <i class="fas fa-comments text-2xl"></i>
                    <p class="mt-2">Belum ada komentar. Jadilah yang pertama untuk memberikan komentar!</p>
                </div>
            </div>

            <!-- Sidebar: Daftar Berita Lainnya -->
            <div class="w-full md:w-1/3 lg:w-1/4">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 text-center">Berita Lainnya</h2>

                <!-- PRODUK (Grid 2 Kolom) -->
                <h3 class="text-md md:text-lg font-semibold text-gray-700 mt-4">Produk</h3>
                <div class="grid grid-cols-2 gap-4">
                    @for ($i = 1; $i <= 2; $i++)
                        <div class="bg-gray-100 p-3 rounded-lg shadow-md hover:bg-gray-200 transition cursor-pointer">
                            <img src="https://via.placeholder.com/150" alt="Thumbnail" class="w-full rounded-md object-cover">
                            <h3 class="font-semibold text-gray-700 text-sm mt-2">Judul Produk {{ $i }}</h3>
                            <p class="text-xs text-gray-600">Kategori | {{ now()->subDays($i)->format('d M Y') }}</p>
                        </div>
                    @endfor
                </div>

                <!-- KARYA (Daftar Vertikal) -->
                <h3 class="text-md md:text-lg font-semibold text-gray-700 mt-4">Karya</h3>
                <div class="space-y-3">
                    @for ($i = 1; $i <= 2; $i++)
                        <div
                            class="flex items-center bg-gray-100 p-3 rounded-lg shadow-md hover:bg-gray-200 transition cursor-pointer">
                            <img src="https://via.placeholder.com/80" alt="Thumbnail"
                                class="w-16 h-16 rounded-md object-cover mr-3">
                            <div>
                                <h3 class="font-semibold text-gray-700 text-sm">Judul Karya {{ $i }}</h3>
                                <p class="text-xs text-gray-600">Kategori | {{ now()->subDays($i)->format('d M Y') }}</p>
                            </div>
                        </div>
                    @endfor
                </div>

                <!-- BERITA POPULER (Slider Horizontal) -->
                <h3 class="text-md md:text-lg font-semibold text-gray-700 mt-4">Berita Populer</h3>
                <div class="flex overflow-x-auto space-x-3 py-2">
                    @for ($i = 1; $i <= 3; $i++)
                        <div
                            class="min-w-[120px] md:min-w-[160px] bg-gray-100 p-3 rounded-lg shadow-md hover:bg-gray-200 transition cursor-pointer">
                            <img src="https://via.placeholder.com/120" alt="Thumbnail" class="w-full rounded-md object-cover">
                            <h3 class="font-semibold text-gray-700 text-xs md:text-sm mt-2">Populer {{ $i }}</h3>
                        </div>
                    @endfor
                </div>

                <!-- BERITA RANDOM (Kartu Besar) -->
                <h3 class="text-md md:text-lg font-semibold text-gray-700 mt-4">Berita Random</h3>
                <div class="space-y-4">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md hover:bg-gray-200 transition cursor-pointer">
                            <img src="https://via.placeholder.com/200" alt="Thumbnail" class="w-full rounded-md object-cover">
                            <h3 class="font-semibold text-gray-700 text-base mt-2">Judul Random {{ $i }}</h3>
                            <p class="text-xs text-gray-600">Kategori | {{ now()->subDays($i)->format('d M Y') }}</p>
                        </div>
                    @endfor
                </div>

            </div>

        </div>
    </main>

    <script>
        let liked = false;
        let disliked = false;
        let likeCount = 0;
        let dislikeCount = 0;

        document.getElementById('likeButton').addEventListener('click', function () {
            if (!liked) {
                likeCount = 1;
                dislikeCount = 0;
                liked = true;
                disliked = false;
            } else {
                likeCount = 0;
                liked = false;
            }
            updateCounts();
        });

        document.getElementById('dislikeButton').addEventListener('click', function () {
            if (!disliked) {
                dislikeCount = 1;
                likeCount = 0;
                disliked = true;
                liked = false;
            } else {
                dislikeCount = 0;
                disliked = false;
            }
            updateCounts();
        });

        function updateCounts() {
            document.getElementById('likeCount').textContent = likeCount;
            document.getElementById('dislikeCount').textContent = dislikeCount;
        }
    </script>
@endsection
