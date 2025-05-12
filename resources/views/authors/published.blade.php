@extends('layouts.app')

@section('content')
    <div class="max-w-[1320px] mx-auto px-4 sm:px-6 py-10">

        <div class="flex justify-between items-center pb-2 border-b border-black mb-4">
            <div>
                <h1 class="text-2xl font-semibold">Publikasi Karya</h1>
                <p class="text-sm text-gray-500 italic">Kumpulan Karya</p>
            </div>

            <div class="flex items-center space-x-2">
                <div class="relative z-30">
                    <form method="GET" action="{{ route('published-media') }}" class="relative">
                        <input type="text" name="search" placeholder="Search" value="{{ request('search') }}"
                            class="bg-white border border-gray-300 px-3 py-2 rounded-full w-64 focus:outline-none focus:ring-1 focus:ring-gray-400 pr-10 text-sm">
                        <span class="absolute right-3 top-2.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                            </svg>
                        </span>
                    </form>
                    <span class="absolute right-3 top-2.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                        </svg>
                    </span>
                </div>

                <div class="relative z-20">
                    @php
                        $sortText = match (request('sort')) {
                            'asc' => 'A-Z Judul',
                            'desc' => 'Z-A Judul',
                            default => 'Terbaru',
                        };
                    @endphp

                    <button onclick="toggleDropdown('sortDropdown')"
                        class="flex items-center space-x-1 bg-red-700 text-white px-4 py-2 rounded-full text-sm shadow-sm hover:bg-red-800 focus:outline-none">
                        <span>{{ $sortText }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="sortDropdown"
                        class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-md hidden z-50">
                        <a href="{{ route('bookmarked', ['sort' => 'asc']) }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">A-Z Judul</a>
                        <a href="{{ route('bookmarked', ['sort' => 'desc']) }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">Z-A Judul</a>
                        <a href="{{ route('bookmarked') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">Terbaru</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-y-scroll h-[75vh] pr-2 space-y-4">
            @forelse ($berita as $item)
                <div class="flex items-start space-x-4 bg-white p-4 rounded shadow-sm">
                    <img src="{{ $item['thumbnail'] }}" alt="Thumbnail" class="w-28 h-20 object-cover rounded">
                    <div class="flex-1">
                        <p class="text-xs font-semibold">
                            <span class="text-[#990505]">{{ strtoupper($item['kategori']) }}</span>
                            <span class="text-[#990505] mx-1">|</span>
                            <span class="text-[#A8A8A8] font-normal">Dibuat
                                {{ \Carbon\Carbon::parse($item['tanggal_dibuat'])->translatedFormat('d F Y') }}</span>
                        </p>
                        <p class="font-medium">{{ $item['judul'] }}</p>
                        <p class="text-xs text-[#A8A8A8] mt-1">Dipublikasikan {{ $item['published_ago'] }}</p>
                    </div>
                    <div class="relative z-30">
                        <button onclick="toggleMenu(this)" class="text-black text-2xl font-bold focus:outline-none">
                            &#8942;
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-24 bg-white border border-gray-200 rounded shadow-md hidden z-10">
                            <a href="{{ route('published.edit', $item['id']) }}"
                                class="block px-3 py-2 hover:bg-gray-100 text-sm">Edit</a>
                            <form action="{{ route('published.destroy', $item['id']) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="block w-full text-left px-3 py-2 hover:bg-gray-100 text-red-500 text-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Tidak ada publikasi yang tersedia.</p>
            @endforelse
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('hidden');
        }

        // Menutup dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('dropdown');
            const button = dropdown.previousElementSibling;
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        function toggleMenu(button) {
            const menu = button.nextElementSibling;
            document.querySelectorAll('.relative > div').forEach(el => {
                if (el !== menu) el.classList.add('hidden');
            });
            menu.classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            document.querySelectorAll('.relative > div').forEach(menu => {
                if (!menu.contains(e.target) && !menu.previousElementSibling.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
