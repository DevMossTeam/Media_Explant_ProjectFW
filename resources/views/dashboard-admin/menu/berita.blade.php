@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-1 py-1">
    
    <div class="flex items-center justify-between my-5">
        <h1 class="font-bold text-2xl">Daftar Berita</h1>
        <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="list-reset flex items-center">
                <li class="flex items-center group text-gray-600 hover:text-black">
                    <i class="fa-solid fa-home mr-1 transition"></i>
                    <a href="/dashboard-admin" class="transition ml-1">Home</a>
                </li>
                <li><span class="mx-2 text-gray-500">></span></li>
                <li class="text-gray-700">Berita</li>
            </ol>
        </nav>
    </div>

    <div class="p-6 bg-white shadow rounded-lg">
        <div class="flex items-center justify-between mb-4">
            <div class="relative flex items-center gap-2">
                <form method="GET" id="perPageForm" class="flex items-center gap-2">
                    <label for="perPage">Show</label>
                    <select name="perPage" id="perPage" onchange="document.getElementById('perPageForm').submit()"
                        class="py-1 pl-2 pr-7 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <div>entries</div>
                </form>
            </div>

            <div class="flex items-center ml-auto">
                <div class="relative max-w-lg mr-4">
                    <input type="text" placeholder="Search..."
                        class="pl-10 pr-4 py-2 border rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 w-full">
                    <i class="fa fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                </div>

                <div class="relative group mr-2">
                    <button id="exportButton"
                        class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 text-gray-600">
                        <i class="fa fa-file-arrow-down text-gray-600"></i>
                        <span>Export</span>
                    </button>
                </div>
                

                <div class="relative group mr-2 inline-block">
                    <button id="filterDropdownBtn" data-dropdown-toggle="filterDropdown"
                        class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 text-gray-600">
                        <i class="fa fa-filter"></i>
                        <span>Filter</span>
                        <svg class="w-2.5 h-2.5 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                
                    <!-- Dropdown content -->
                    <div id="filterDropdown"
                        class="z-10 hidden absolute right-0 mt-2 w-90 bg-white border border-gray-200 rounded-lg shadow-md p-4 space-y-4">
                        <!-- Kategori -->
                        <div>
                            <p class="text-sm font-semibold mb-2">Kategori</p>
                            <div class="grid grid-cols-2 gap-2 text-sm text-gray-700">
                                @foreach(['kampus', 'kesehatan', 'kesenian-hiburan', 'liputan-khusus', 'nasional-internasional', 'olahraga', 'opini-esai', 'teknologi'] as $kategori)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="kategori-{{ $kategori }}" name="kategori[]" value="{{ $kategori }}"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="kategori-{{ $kategori }}"
                                            class="ml-2 capitalize">{{ str_replace('-', ' ', $kategori) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                
                        <!-- Urutan -->
                        <div>
                            <p class="text-sm font-semibold mb-2">Urutkan berdasarkan</p>
                            <div class="flex flex-col gap-2 text-sm text-gray-700">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="order" value="terbaru" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2">Terbaru</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="order" value="terpopuler" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2">View Paling Banyak</span>
                                </label>
                            </div>
                        </div>
                
                        <!-- Tanggal -->
                        <div>
                            <p class="text-sm font-semibold mb-2">Tanggal</p>
                            <div class="flex items-center gap-2">
                                <input type="date" name="tanggal_dari"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <i class="fa-solid fa-arrow-right text-gray-500 text-sm"></i>
                                <input type="date" name="tanggal_sampai"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        
                
                        <!-- Status Berita -->
                        <div>
                            <p class="text-sm font-semibold mb-2">Status Berita</p>
                            <div class="flex gap-4 text-sm text-gray-700">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="publik" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2">Publik</span>
                                </label>                                
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="private" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2">Private</span>
                                </label>
                            </div>
                        </div>
                
                        <!-- Tag -->
                        <div>
                            <p class="text-sm font-semibold mb-2">Tag</p>
                            <input type="text" name="tag" placeholder="Masukkan tag"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                
                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Terapkan</button>
                        </div>
                    </div>
                </div>
                
                <!-- Tambahkan script jika pakai Alpine atau toggle manual -->
                <script>
                    document.getElementById('filterDropdownBtn').addEventListener('click', function () {
                        const dropdown = document.getElementById('filterDropdown');
                        dropdown.classList.toggle('hidden');
                    });
                </script>
                
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-600">
                    <tr>
                        <th class="p-3 w-20">Cover</th>
                        <th class="p-3">Judul Berita</th>
                        <th class="p-3">Nama Penulis</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Visibilitas</th>
                        <th class="p-3">Tanggal Diterbitkan</th>
                        <th class="p-3 text-center w-32">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                @foreach ($beritas as $berita)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">
                            @php
                                // Use regular expression to find the first image in konten_berita
                                preg_match('/<img[^>]+src=["\'](.*?)["\']/i', $berita->konten_berita, $matches);
                                $imageUrl = $matches[1] ?? 'https://via.placeholder.com/48x48'; // Fallback if no image found
                            @endphp
                            <img src="{{ $imageUrl }}" alt="Cover"
                                class="w-12 h-12 object-cover rounded">
                        </td>
                        <td class="p-3 font-medium">{{ $berita->judul ?? 'N/A' }}</td>
                        <td class="p-3">
                            {{ $berita->user?->nama_pengguna ?? 'N/A' }}
                        </td> 
                        <td class="p-3">
                            {{ $berita->kategori ?? 'N/A' }}

                        </td>                       

                        <td class="p-3">
                            <span class="text-xs font-semibold px-2 py-1 rounded-full
                                {{ $berita->visibilitas === 'public' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                {{ ucfirst($berita->visibilitas) }}
                            </span>
                        </td>
                        <td class="p-3 text-sm text-gray-500">{{ $berita->tanggal_diterbitkan }}</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <div class="relative group">
                                <button class="view-btn w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition"
                                        onclick="window.location.href='{{ route('admin.berita.detail', $berita->id) }}'">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <div class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">
                                    Melihat
                                </div>
                            </div>            
                        
                            <div class="relative group">
                                <button class="delete-btn w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition"
                                        data-id="{{ $berita->id }}" data-url="{{ route('admin.berita.delete', $berita->id) }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <div class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition">
                                    Hapus
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody> 
            </table>
        </div>

        {{-- pagination --}}
        {{-- <div class="mt-4">
            {{ $beritas->links() }}
        </div> --}}

        <div class="mt-4">
            <div class="flex items-center justify-between mt-4 text-sm text-gray-600">
                <!-- Showing X to Y of Z entries -->
                <div>
                    Showing
                    {{ $beritas->firstItem() }}
                    to
                    {{ $beritas->lastItem() }}
                    of
                    {{ $beritas->total() }}
                    entries
                </div>
        
                <!-- Pagination buttons -->
                <div class="flex space-x-1">
                    <!-- Previous button -->
                    @if ($beritas->onFirstPage())
                        <button class="px-3 py-1 border rounded text-gray-600 cursor-not-allowed">Previous</button>
                    @else
                        <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-100"
                                onclick="window.location.href='{{ $beritas->previousPageUrl() }}'">
                            Previous
                        </button>
                    @endif
        
                    <!-- Page numbers -->
                    @for ($i = 1; $i <= $beritas->lastPage(); $i++)
                        @if ($i == $beritas->currentPage())
                            <button class="px-3 py-1 border rounded bg-blue-500 text-white">{{ $i }}</button>
                        @else
                            <button class="px-3 py-1 border rounded text-gray-600 hover:bg-blue-100"
                                    onclick="window.location.href='{{ $beritas->url($i) }}'">
                                {{ $i }}
                            </button>
                        @endif
                    @endfor
        
                    <!-- Next button -->
                    @if ($beritas->hasMorePages())
                        <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-100"
                                onclick="window.location.href='{{ $beritas->nextPageUrl() }}'">
                            Next
                        </button>
                    @else
                        <button class="px-3 py-1 border rounded text-gray-600 cursor-not-allowed">Next</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                const deleteUrl = btn.getAttribute('data-url');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33', // Red color for "Ya, hapus!"
                    cancelButtonColor: '#3085d6', // Blue color for "Batal"
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'bg-red-500 text-white hover:bg-red-600 transition', // Custom class for confirm button
                        cancelButton: 'bg-blue-500 text-white hover:bg-blue-600 transition' // Custom class for cancel button
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });

        
    });

   document.getElementById('exportButton').addEventListener('click', function () {
    Swal.fire({
        title: 'Menyiapkan file...',
        html: 'Silakan tunggu, file sedang diproses.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'File berhasil disiapkan. Unduhan dimulai.',
            timer: 2000,
            showConfirmButton: false
        });

        // Unduh file di tab baru
        window.open('/path/to/exported-file.xlsx', '_blank');
    }, 2000);
});

    // Print all data in JSON to console
    // const beritaData = @json($beritas);
    //     console.log("Semua data berita (paginated):", beritaData);
</script>
@endsection