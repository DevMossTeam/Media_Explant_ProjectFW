@extends('layouts.app')

@section('content')
    <div class="max-w-[1320px] mx-auto px-4 sm:px-6 py-10">
        <div class="flex justify-between items-center pb-2 border-b border-black mb-4">
            <div>
                <h1 class="text-2xl font-semibold">Disukai</h1>
                <p class="text-sm text-gray-500 italic">Karya yang Anda sukai</p>
            </div>

            <div class="flex items-center space-x-2 relative z-10">
                <form method="GET" action="{{ route('liked') }}" class="relative z-10">
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
                        <a href="{{ route('liked', ['sort' => 'asc']) }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">A-Z Judul</a>
                        <a href="{{ route('liked', ['sort' => 'desc']) }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">Z-A Judul</a>
                        <a href="{{ route('liked') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Terbaru</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-y-scroll h-[75vh] pr-2 space-y-4 relative z-0">
            @forelse ($likedItems as $item)
                <div class="flex items-start space-x-4 bg-white p-4 rounded shadow-sm relative z-10">
                    <img src="{{ $item['thumbnail'] }}" alt="Thumbnail" class="w-28 h-20 object-cover rounded">
                    <div class="flex-1">
                        <p class="text-xs font-semibold">
                            <span class="text-[#990505]">{{ strtoupper($item['kategori']) }}</span>
                            <span class="text-[#990505] mx-1">|</span>
                            <span class="text-[#A8A8A8] font-normal">Disukai
                                {{ \Carbon\Carbon::parse($item['tanggal_disukai'])->translatedFormat('d F Y') }}</span>
                        </p>
                        <p class="font-medium">{{ $item['judul'] }}</p>
                        <p class="text-xs text-[#A8A8A8] mt-1">Disukai {{ $item['disukai_ago'] }}</p>
                    </div>
                    <div class="relative z-20">
                        <button onclick="toggleDropdown('menu-{{ $item['id'] }}')"
                            class="text-gray-700 hover:text-gray-900 focus:outline-none text-2xl px-2 leading-none">⋮</button>
                        <div id="menu-{{ $item['id'] }}"
                            class="absolute right-0 mt-2 w-28 bg-white border border-gray-200 rounded shadow-md hidden z-50">
                            <a href="/kategori/{{ strtolower($item['kategori']) }}/read?a={{ $item['id'] }}"
                                class="block px-3 py-2 text-sm hover:bg-gray-100 text-gray-700">Lihat</a>
                            <button onclick="openModal('{{ route('liked.destroy', $item['id']) }}')"
                                class="block w-full text-left px-3 py-2 hover:bg-gray-100 text-red-500 text-sm">Hapus</button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada karya yang disukai.</p>
            @endforelse
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Konfirmasi Hapus</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-lg">&times;</button>
            </div>
            <div class="mt-4 flex items-center justify-center">
                <svg class="w-12 h-12 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
            </div>
            <p class="text-center mt-4 text-gray-600">Apakah Anda yakin ingin menghapus item ini?</p>
            <div class="mt-6 flex justify-between">
                <button onclick="closeModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown(id) {
            document.querySelectorAll('[id^="menu-"], #sortDropdown').forEach(el => {
                if (el.id !== id) el.classList.add('hidden');
            });
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            const clickedInsideDropdown = e.target.closest(
                '[id^="menu-"], #sortDropdown, [onclick^="toggleDropdown"], #deleteModal');
            if (!clickedInsideDropdown) {
                document.querySelectorAll('[id^="menu-"], #sortDropdown').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });

        function openModal(actionUrl) {
            document.getElementById('deleteForm').action = actionUrl;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.addEventListener('click', function(e) {
            if (e.target.id === 'deleteModal') {
                closeModal();
            }
        });
    </script>
@endsection
