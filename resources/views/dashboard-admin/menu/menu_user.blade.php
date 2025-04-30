@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-1 py-1">
    
    <div class="flex items-center justify-between my-5">
        <h1 class="font-bold text-2xl">Daftar Pengguna</h1>
        <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="list-reset flex items-center">
                <li class="flex items-center group text-gray-600 hover:text-black">
                    <i class="fa-solid fa-home mr-1 transition"></i>
                    <a href="/dashboard-admin" class="transition ml-1">Home</a>
                </li>
                <li><span class="mx-2 text-gray-500">></span></li>
                <li class="text-gray-700">User</li>
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
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 text-gray-600">
                        <i class="fa fa-file-arrow-down text-gray-600"></i>
                        <span>Export</span>
                    </button>
                </div>

                <div class="relative group mr-2">
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 text-gray-600">
                        <i class="fa fa-filter"></i>
                        <span>Filter</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-50 text-xs font-semibold text-gray-600">
                    <tr>
                        <th class="p-3">UID</th>
                        <th class="p-3">Nama Pengguna</th>
                        <th class="p-3">Nama Lengkap</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Role</th>
                        <th class="p-3 text-center w-32">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 font-medium">{{ $user->uid }}</td>
                        <td class="p-3">{{ $user->nama_pengguna }}</td>
                        <td class="p-3">{{ $user->nama_lengkap }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3 capitalize">{{ $user->role }}</td>
                        <td class="p-3 flex justify-center space-x-2">
                            <div class="relative group">
                                <button class="w-9 h-9 flex items-center justify-center rounded-full border border-blue-500 text-blue-500 hover:bg-blue-50 transition lihat-detail-btn"
    data-nama="{{ $user->nama_lengkap }}"
    data-username="{{ $user->nama_pengguna }}"
    data-email="{{ $user->email }}"
    data-role="{{ $user->role }}"
    data-uid="{{ $user->uid }}">
    <i class="fa fa-eye"></i>
</button>
                                <div class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                                    Melihat Detail
                                </div>
                                
                            </div>            

                            <div class="relative group">
                                <button class="delete-btn w-9 h-9 flex items-center justify-center rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition"
                                    data-id="{{ $user->uid }}" data-url="#">
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

        <div class="mt-4">
            <div class="flex items-center justify-between mt-4 text-sm text-gray-600">
                <div>
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                </div>

                <div class="flex space-x-1">
                    @if ($users->onFirstPage())
                        <button class="px-3 py-1 border rounded text-gray-600 cursor-not-allowed">Previous</button>
                    @else
                        <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-100"
                                onclick="window.location.href='{{ $users->previousPageUrl() }}'">
                            Previous
                        </button>
                    @endif

                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        @if ($i == $users->currentPage())
                            <button class="px-3 py-1 border rounded bg-blue-500 text-white">{{ $i }}</button>
                        @else
                            <button class="px-3 py-1 border rounded text-gray-600 hover:bg-blue-100"
                                    onclick="window.location.href='{{ $users->url($i) }}'">
                                {{ $i }}
                            </button>
                        @endif
                    @endfor

                    @if ($users->hasMorePages())
                        <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-100"
                                onclick="window.location.href='{{ $users->nextPageUrl() }}'">
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
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'bg-red-500 text-white hover:bg-red-600 transition',
                        cancelButton: 'bg-blue-500 text-white hover:bg-blue-600 transition'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });

         // Lihat Detail
    document.querySelectorAll('.lihat-detail-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const nama = btn.getAttribute('data-nama');
            const username = btn.getAttribute('data-username');
            const email = btn.getAttribute('data-email');
            const role = btn.getAttribute('data-role');
            const uid = btn.getAttribute('data-uid');

            Swal.fire({
    title: `<strong>Detail Pengguna</strong>`,
    html: `
        <div class="text-left">
            <p><strong>UID:</strong> ${uid}</p>
            <p><strong>Username:</strong> ${username}</p>
            <p><strong>Nama Lengkap:</strong> ${nama}</p>
            <p><strong>Email:</strong> ${email}</p>
            <p><strong>Role:</strong> ${role}</p>
        </div>
    `,
    icon: 'info',
    confirmButtonText: 'Tutup',
    showCloseButton: true, // ⬅️ tombol X di pojok kanan atas
    customClass: {
        popup: 'text-sm'
    }
});

        });
    });

        // Print user data to console (for debugging)
        const userData = @json($users);
        console.log("Semua data user (paginated):", userData);
    });
</script>
@endsection
