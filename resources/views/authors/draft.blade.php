@extends('layouts.app')

@section('content')
    <div class="max-w-[1320px] mx-auto px-4 sm:px-6 py-10">
        <div class="flex justify-between items-center pb-2 border-b border-black mb-4">
            <div>
                <h1 class="text-2xl font-semibold">Draft Karya</h1>
                <p class="text-sm text-gray-500 italic">Kumpulan Karya</p>
            </div>

            <div class="flex items-center space-x-2 relative z-30">
                <form method="GET" action="{{ route('draft-media') }}" class="relative z-30">
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

                <div class="relative z-30">
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
                        <a href="{{ route('draft-media', ['sort' => 'asc']) }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">A-Z Judul</a>
                        <a href="{{ route('draft-media', ['sort' => 'desc']) }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">Z-A Judul</a>
                        <a href="{{ route('draft-media', ['sort' => 'recent']) }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">Terbaru</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-y-scroll h-[75vh] pr-2 space-y-4 relative z-0">
            @forelse ($berita as $item)
                <div class="flex items-start space-x-4 bg-white p-4 rounded shadow-sm relative z-10">
                    <img src="{{ $item['thumbnail'] }}" alt="Thumbnail" class="w-28 h-20 object-cover rounded">
                    <div class="flex-1">
                        <p class="text-xs font-semibold">
                            <span class="text-[#990505]">{{ strtoupper($item['kategori']) }}</span>
                            <span class="text-[#990505] mx-1">|</span>
                            <span class="text-[#A8A8A8] font-normal">Dibuat
                                {{ \Carbon\Carbon::parse($item['tanggal_dibuat'])->translatedFormat('d F Y') }}</span>
                        </p>
                        <p class="font-medium">{{ $item['judul'] }}</p>
                        <p class="text-xs text-[#A8A8A8] mt-1">Dipublikasikan {{ $item['draft_ago'] }}</p>
                    </div>
                    <div class="relative z-40">
                        <button onclick="toggleDropdown('menu-{{ $item['id'] }}')"
                            class="text-black text-2xl font-bold focus:outline-none">&#8942;</button>
                        <div id="menu-{{ $item['id'] }}"
                            class="absolute right-0 mt-2 w-24 bg-white border border-gray-200 rounded shadow-md hidden z-50">
                            <a href="{{ route('draft.edit', $item['id']) }}"
                                class="block px-3 py-2 hover:bg-gray-100 text-sm">Edit</a>
                            <form action="{{ route('draft.destroy', [$item['id'], 'tipe' => $item['tipe']]) }}"
                                method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
            @if ($paginate)
                <div class="mt-4">
                    {{ $berita->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleDropdown(id) {
            document.querySelectorAll('[id^="menu-"], #sortDropdown').forEach(el => {
                if (el.id !== id) el.classList.add('hidden');
            });
            const dropdown = document.getElementById(id);
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            const isDropdownClick = e.target.closest(
                '[id^="menu-"], #sortDropdown, button[onclick^="toggleDropdown"]');
            if (!isDropdownClick) {
                document.querySelectorAll('[id^="menu-"], #sortDropdown').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });
    </script>
@endsection
