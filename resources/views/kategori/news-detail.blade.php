@extends('layouts.app')

@section('content')
    <main class="py-1">
        <div
            class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl flex flex-col lg:flex-row gap-8">
            <!-- Konten Kiri -->
            <div class="w-full lg:w-3/5">
                <!-- Label Kategori -->
                <div class="flex flex-col mb-8">
                    <div class="flex items-center">
                        <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                        <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]"
                            style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                            {{ $news->kategori }}
                        </h2>
                    </div>
                    <div class="w-full h-[2px] bg-gray-300"></div>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">{{ $news->judul }}</h1>
                <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                    <div>
                        Oleh: {{ $news->user->nama_lengkap ?? 'Tidak Diketahui' }} -
                        {{ \Carbon\Carbon::parse($news->tanggal_diterbitkan)->format('d F Y - H.i') }} WIB
                    </div>
                    <button class="flex items-center gap-2 text-gray-400 hover:text-gray-800">
                        <span class="text-sm">Simpan dan baca nanti</span>
                        <i class="far fa-bookmark text-xl"></i>
                    </button>
                </div>

                @if (!str_contains($news->konten_berita, '<img'))
                    <div class="mb-6">
                        <img src="{{ $news->first_image }}" alt="Gambar Ilustrasi"
                            class="rounded-lg shadow-md w-full max-w-full mx-auto pointer-events-none select-none">
                    </div>
                @endif

                {!! preg_replace(
                    ['/<a[^>]*>\s*(<img[^>]*>)\s*<\/a>/i', '/<img(.*?)>/i'],
                    ['$1', '<img$1 class="mx-auto pointer-events-none select-none mb-6 rounded-lg w-full h-auto">'],
                    $news->konten_berita,
                ) !!}

                <!-- Tanggapan -->
                <div class="mt-5">
                    <div class="text-sm font-semibold text-black mb-2">Beri Tanggapanmu :</div>
                    <div class="flex items-center gap-6 text-[#ABABAB]">
                        <button class="flex items-center gap-2 hover:text-gray-700">
                            <i class="fas fa-thumbs-up"></i> 107
                        </button>
                        <button class="flex items-center gap-2 hover:text-gray-700">
                            <i class="fas fa-thumbs-down"></i> 0
                        </button>
                        <button class="flex items-center gap-2 hover:text-gray-700">
                            <i class="fas fa-share-nodes"></i> Share
                        </button>
                        <button class="ml-auto text-red-600 hover:text-red-800 bg-red-100 rounded-full p-2">
                            <i class="fas fa-flag"></i>
                        </button>
                    </div>
                </div>

                <!-- Komentar -->
                <div class="mt-5">
                    <form action="#" method="POST">
                        @csrf
                        <div class="relative w-full">
                            <input type="text" name="komentar" placeholder="Tulis komentarmu disini"
                                class="w-full border border-[#9A0605] rounded-full pr-12 pl-4 py-2 text-sm focus:outline-none" />
                            <button type="submit"
                                class="absolute right-0 top-0 bottom-0 w-10 flex items-center justify-center bg-[#9A0605] rounded-full rounded-l-none text-white hover:bg-red-800">
                                <i class="fas fa-paper-plane text-sm"></i>
                            </button>
                        </div>
                    </form>
                    <div class="mt-3 border border-gray-200 rounded-lg p-4 bg-gray-50 text-sm text-gray-500 text-center">
                        Belum Ada Komentar
                    </div>
                </div>
            </div>

            <!-- Konten Kanan -->
            <div class="w-full lg:w-2/5">
                <!-- Berita Terkait -->
                @if (isset($relatedNews))
                    <div class="mb-6">
                        <div class="flex flex-col mb-4">
                            <div class="flex items-center">
                                <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                                <h3 class="text-white font-bold bg-[#9A0605] px-6 py-1 text-lg"
                                    style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                                    Berita Terkait
                                </h3>
                            </div>
                            <div class="w-full h-[2px] bg-gray-300"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($relatedNews as $item)
                                <div>
                                    <a href="?a={{ $item->id }}">
                                        <img src="{{ $item->thumbnail ?? $item->first_image }}"
                                            class="w-full h-36 object-cover rounded-md" alt="{{ $item->judul }}">
                                    </a>
                                    <a href="?a={{ $item->id }}">
                                        <div class="font-bold text-sm text-gray-700 mt-2">{{ $item->judul }}</div>
                                    </a>
                                    <div class="flex items-center gap-3 text-xs text-[#ABABAB] font-semibold mt-1">
                                        <span>{{ $item->user->nama_lengkap ?? '-' }}</span>
                                        <div class="flex gap-2">
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-thumbs-up"></i><span>107</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-solid fa-share-nodes"></i><span>Share</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Mungkin Anda Suka -->
                @if (isset($recommendedNews))
                    <div class="mb-6">
                        <div class="flex flex-col mb-4">
                            <div class="flex items-center">
                                <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                                <h3 class="text-white font-bold bg-[#9A0605] px-6 py-1 text-lg"
                                    style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                                    Mungkin Anda Suka
                                </h3>
                            </div>
                            <div class="w-full h-[2px] bg-gray-300"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($recommendedNews as $item)
                                <div>
                                    <a href="?a={{ $item->id }}">
                                        <img src="{{ $item->thumbnail ?? $item->first_image }}"
                                            class="w-full h-36 object-cover rounded-md" alt="{{ $item->judul }}">
                                    </a>
                                    <a href="?a={{ $item->id }}">
                                    <div class="font-bold text-sm text-gray-700 mt-2">{{ $item->judul }}</div>
                                    </a>
                                    <div class="flex items-center gap-3 text-xs text-[#ABABAB] font-semibold mt-1">
                                        <span>{{ $item->user->nama_lengkap ?? '-' }}</span>
                                        <div class="flex gap-2">
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-thumbs-up"></i><span>107</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-solid fa-share-nodes"></i><span>Share</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Topik Lainnya -->
        @if (isset($otherTopics))
            <div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 mt-10 mb-20">
                <div class="flex flex-col mb-4">
                    <div class="flex items-center">
                        <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                        <h3 class="text-white font-bold bg-[#9A0605] px-6 py-1 text-lg"
                            style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                            Topik Lainnya
                        </h3>
                    </div>
                    <div class="w-full h-[2px] bg-gray-300"></div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($otherTopics as $item)
                        <div>
                            <a href="?a={{ $item->id }}">
                                <img src="{{ $item->thumbnail ?? $item->first_image }}"
                                    class="w-full h-36 object-cover rounded-md" alt="{{ $item->judul }}">
                            </a>
                            <a href="?a={{ $item->id }}">
                            <div class="font-bold text-sm text-gray-700 mt-2">{{ $item->judul }}</div>
                            </a>
                            <div class="flex items-center gap-3 text-xs text-[#ABABAB] font-semibold mt-1">
                                <span>{{ $item->user->nama_lengkap ?? '-' }}</span>
                                <div class="flex gap-2">
                                    <div class="flex items-center gap-1">
                                        <i class="fa-regular fa-thumbs-up"></i><span>107</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <i class="fa-solid fa-share-nodes"></i><span>Share</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    <script>
        let liked = false;
        let disliked = false;
        let likeCount = 0;
        let dislikeCount = 0;

        document.getElementById('likeButton').addEventListener('click', function() {
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

        document.getElementById('dislikeButton').addEventListener('click', function() {
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
