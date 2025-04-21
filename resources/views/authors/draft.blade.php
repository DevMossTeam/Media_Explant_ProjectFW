{{-- draft.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-semibold mb-1">Draft Karya</h2>
    <p class="text-sm text-gray-500 mb-6">Kumpulan Karya</p>

    {{-- Search and Sort --}}
    <div class="flex justify-between items-center mb-4">
        <input type="text" placeholder="Search" class="border px-3 py-2 rounded w-1/2 focus:outline-none">
        <button class="bg-red-600 text-white px-4 py-2 rounded text-sm">A - Z Group</button>
    </div>

    {{-- List --}}
    <div class="space-y-4 max-h-[80vh] overflow-y-auto pr-2">
        @for($i = 0; $i < 15; $i++)
        <div class="flex items-start bg-white shadow rounded-lg p-4 relative">
            {{-- Image Thumbnail --}}
            <img src="{{ asset($i % 2 == 0 ? 'images/tari-saman.jpg' : 'images/majalah-online.jpg') }}"
                 class="w-32 h-20 object-cover rounded mr-4" alt="Thumbnail">

            {{-- Text Content --}}
            <div class="flex-1">
                <div class="text-xs uppercase font-semibold text-red-600">
                    {{ $i % 2 == 0 ? 'Kesenian' : 'Majalah' }}
                    <span class="text-gray-500 font-normal ml-2">| Dibuat {{ $i % 2 == 0 ? '13 Feb 2025' : '07 Dec 2024' }}</span>
                </div>
                <h3 class="font-semibold text-sm mt-1 mb-1">
                    {{ $i % 2 == 0 ? 'Tari Saman: Memahami Makna, Sejarah, Fungsi, dan Pola Lantai' : 'Majalah Himpunan Mahasiswa Teknik ...' }}
                </h3>
                <p class="text-xs text-gray-400">Diperbarui 2 jam yang lalu</p>
            </div>

            {{-- Dropdown Action --}}
            <div class="relative">
                <button onclick="toggleDropdown({{ $i }})" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div id="dropdown-{{ $i }}" class="hidden absolute right-0 mt-2 w-24 bg-white border rounded shadow-lg z-10">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                    <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Hapus</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>

<script>
    function toggleDropdown(index) {
        const dropdown = document.getElementById('dropdown-' + index);
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            if (el !== dropdown) el.classList.add('hidden');
        });
        dropdown.classList.toggle('hidden');
    }

    // Klik di luar menu untuk menutup
    window.addEventListener('click', function (e) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            if (!el.contains(e.target) && !e.target.closest('button')) {
                el.classList.add('hidden');
            }
        });
    });
</script>
@endsection
