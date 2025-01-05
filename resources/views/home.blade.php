@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap gap-6">
        <!-- Kontainer Berita -->
        <div class="w-full flex flex-col lg:flex-row gap-4">
            <!-- Berita Utama -->
            <div class="w-full lg:w-3/5 bg-white shadow overflow-hidden relative">
                <a href="{{ route('article.detail', ['id' => 1]) }}">
                    <img src="https://via.placeholder.com/800x400" alt="Berita Utama" class="w-full h-60 sm:h-72 lg:h-80 object-cover">
                </a>
                <div class="absolute bottom-0 bg-gradient-to-t from-black via-transparent to-transparent text-white p-4 w-full">
                    <a href="{{ route('article.detail', ['id' => 1]) }}">
                        <h2 class="text-lg sm:text-xl font-bold uppercase">PEMBEKUAN DAN SERANGAN SIBER TERHADAP BEM FISIP UNAIR</h2>
                    </a>
                    <p class="text-sm mt-2">Anonym - {{ date('d M Y') }}</p>
                </div>
            </div>

            <!-- Berita Tambahan -->
            <aside class="w-full lg:w-2/5 grid grid-cols-2 gap-4">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="bg-white shadow overflow-hidden relative">
                        <a href="{{ route('article.detail', ['id' => $i + 1]) }}">
                            <img src="https://via.placeholder.com/400x200" alt="Berita {{ $i }}" class="w-full h-36 sm:h-48 lg:h-52 object-cover">
                        </a>
                        <div class="absolute bottom-0 bg-gradient-to-t from-black via-transparent to-transparent text-white p-2 w-full">
                            <a href="{{ route('article.detail', ['id' => $i + 1]) }}">
                                <h3 class="text-xs sm:text-sm lg:text-base font-bold">Judul Berita {{ $i }}</h3>
                            </a>
                            <p class="text-xs mt-1">Anonym - {{ date('d M Y') }}</p>
                        </div>
                    </div>
                @endfor
            </aside>
        </div>

        <!-- Bagian Baru (Berita Siaran Pers dan Agenda) -->
        <div class="w-full flex flex-col lg:flex-row gap-6 mt-8">
            <!-- Bagian Siaran Pers -->
            <div class="w-full lg:w-2/3">
                <h2 class="text-2xl font-bold mb-4 border-b pb-2">SIARAN PERS</h2>
                <div class="bg-white shadow overflow-hidden">
                    <a href="{{ route('article.detail', ['id' => 5]) }}">
                        <img src="https://via.placeholder.com/800x400" alt="HRW: Student Media at Risk" class="w-full h-64 object-cover">
                    </a>
                    <div class="p-4">
                        <a href="{{ route('article.detail', ['id' => 5]) }}">
                            <h3 class="text-xl font-bold">HRW: Student Media at Risk</h3>
                        </a>
                        <p class="text-sm text-gray-600 mb-2">Admin Persma - 22 Mei 2023</p>
                        <p class="text-gray-800 text-justify">College Journalists Face Intimidation, Censorship, Newsroom Closures Student journalists pose under a street sign in Pekanbaru, Riau, named for their magazine...</p>
                        <span class="text-red-600 font-bold mt-4 inline-block">Baca Selengkapnya</span>
                    </div>
                </div>
            </div>

            <!-- Bagian Agenda -->
            <aside class="w-full lg:w-1/3">
                <h2 class="text-2xl font-bold mb-4 border-b pb-2">AGENDA</h2>
                <div class="space-y-4">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="bg-white shadow p-4">
                            <a href="{{ route('article.detail', ['id' => $i + 5]) }}">
                                <h3 class="text-lg font-bold">Judul Agenda {{ $i }}</h3>
                            </a>
                            <p class="text-sm text-gray-600">4 Agustus 2023</p>
                            <p class="text-sm text-gray-800">Deskripsi singkat agenda {{ $i }} yang menarik perhatian pembaca...</p>
                            <span class="text-red-600 font-bold mt-2 inline-block">Baca Selengkapnya</span>
                        </div>
                    @endfor
                </div>
            </aside>
        </div>

        <!-- Bagian Populer -->
        <div class="w-full mt-8">
            <h2 class="text-2xl font-bold mb-4 border-b pb-2">POPULER</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="bg-white shadow p-4">
                        <a href="{{ route('article.detail', ['id' => $i + 8]) }}">
                            <h3 class="text-lg font-bold">Judul Populer {{ $i }}</h3>
                        </a>
                        <p class="text-sm text-gray-600">Anonym - {{ date('d M Y') }}</p>
                        <p class="text-sm text-gray-800">Deskripsi singkat berita populer {{ $i }}...</p>
                        <span class="text-red-600 font-bold mt-2 inline-block">Baca Selengkapnya</span>
                    </div>
                @endfor
            </div>
            <div class="mt-4 text-center">
                <button class="px-6 py-2 bg-red-600 text-white font-bold rounded hover:bg-red-700">Muat Lebih</button>
            </div>
        </div>

        <!-- Bagian Tambahan -->
        <div class="w-full mt-8 flex flex-col lg:flex-row gap-6">
            <!-- Bagian Riset -->
            <div class="w-full lg:w-1/3">
                <h2 class="text-2xl font-bold mb-4 border-b pb-2">RISET</h2>
                <div class="space-y-4">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="bg-white shadow p-4">
                            <a href="{{ route('article.detail', ['id' => $i + 10]) }}">
                                <h3 class="text-lg font-bold">Judul Riset {{ $i }}</h3>
                            </a>
                            <p class="text-sm text-gray-600">29 Maret 2023</p>
                            <p class="text-sm text-gray-800">Deskripsi singkat riset {{ $i }}...</p>
                            <span class="text-red-600 font-bold mt-2 inline-block">Baca Selengkapnya</span>
                        </div>
                    @endfor
                </div>
                <div class="mt-4 text-center">
                    <button class="px-6 py-2 bg-gray-200 text-gray-700 font-bold rounded hover:bg-gray-300">Muat Lebih</button>
                </div>
            </div>

            <!-- Berita Diskusi -->
            <div class="w-full lg:w-2/3">
                <h2 class="text-2xl font-bold mb-4 border-b pb-2">DISKUSI</h2>
                <div class="bg-white shadow overflow-hidden">
                    <a href="{{ route('article.detail', ['id' => 15]) }}">
                        <img src="https://via.placeholder.com/800x400" alt="Diskusi Gambar" class="w-full h-64 object-cover">
                    </a>
                    <div class="p-4">
                        <a href="{{ route('article.detail', ['id' => 15]) }}">
                            <h3 class="text-xl font-bold">Memahami Payung Hukum dan Perlindungan Pers Mahasiswa</h3>
                        </a>
                        <p class="text-sm text-gray-600 mb-2">Dimas Wahyu Gilang - 16 September 2024</p>
                        <p class="text-gray-800 text-justify">Munculnya wacana mengenai payung hukum kembali mencuat setelah Musyawarah Kerja Nasional (Mukernas) Perhimpunan Pers Mahasiswa Indonesia (PPMI) di Yogyakarta...</p>
                        <span class="text-red-600 font-bold mt-4 inline-block">Baca Selengkapnya</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Galeri -->
        <div class="w-full mt-8">
            <h2 class="text-2xl font-bold mb-4 border-b pb-2">GALERI</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="bg-white shadow overflow-hidden">
                        <a href="{{ route('article.detail', ['id' => $i + 14]) }}">
                            <img src="https://via.placeholder.com/400x400" alt="Galeri {{ $i }}" class="w-full h-40 sm:h-48 object-cover">
                        </a>
                        <div class="p-2">
                            <h3 class="text-sm font-bold">Galeri {{ $i }}</h3>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</main>
@endsection
