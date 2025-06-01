@extends('layouts.admin-layouts')
@section('content')
<div class="container mx-auto px-1 py-1">
    <div class="mb-6">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-gray-500 space-x-2" aria-label="Breadcrumb">
            <a href="/dashboard-admin" class="flex items-center text-gray-600 hover:text-blue-600 transition">
                <i class="fa-solid fa-house mr-1"></i>
                <span>Home</span>
            </a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-700 font-medium">Kotak Masuk</span>
        </nav>

        <!-- Title -->
        <h1 class="mt-3 text-2xl font-bold text-gray-800">Kotak Masuk</h1>
    </div>

    <div class="flex gap-4">
        <!-- Sidebar -->
        <aside class="w-64 bg-white p-4 rounded-xl shadow">
            {{-- <button class="w-full bg-indigo-600 text-white py-2 rounded-xl mb-6 font-semibold">Compose</button> --}}
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-500 mb-2">KOTAK PESAN</h3>
                <ul class="space-y-2">
                    <li
                        class="flex justify-between items-center text-blue-600 font-medium bg-blue-100 px-2 py-2 rounded-lg">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-inbox"></i> Kotak Masuk </span>
                        <span
                            class="text-sm bg-indigo-100 text-indigo-600 rounded-full px-2">{{ $pesans->total() }}</span>
                    </li>
                </ul>
            </div>

            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Filter</h3>
                <ul class="space-y-2">
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'showAll']) }}">
                        <li class="hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                            <i class="text-gray-500 fa-solid fa-envelope"></i> Semua pesan
                        </li>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'starred']) }}">
                        <li class="hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                            <i class="text-yellow-300 fa-solid fa-star"></i> Starred
                        </li>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'terbaru']) }}">
                        <li class="hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                            <i class="text-blue-500 fa-solid fa-calendar"></i> Terbaru
                        </li>
                    </a>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Tipe</h3>
                <ul class="space-y-2">
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'masukan']) }}">
                        <li
                            class="flex items-center gap-2 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            Masukan
                        </li>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'laporan']) }}">
                        <li
                            class="flex items-center gap-2 hover:text-blue-600 hover:bg-blue-100 px-2 py-2 rounded-lg cursor-pointer">
                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                            Laporan
                        </li>
                    </a>
                </ul>
            </div>
        </aside>

        <!-- Main Inbox -->
        <div class="flex-1 bg-white rounded-xl shadow p-4 h-[600px] overflow-y-auto">
            <!-- Top actions -->
            <form id="bulkActionForm" action="{{ route('kotak-masuk.bulk-delete') }}" method="POST">
                @csrf
                @method('DELETE')

                <input type="hidden" name="message_ids" id="message-ids" value="" />

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="selectAll" />
                        {{-- <button href="/" title="Refresh" class="p-1 hover:bg-gray-100 rounded">🔄</button> --}}
                        <button type="submit" title="Delete" class="p-1 hover:bg-gray-100 rounded">🗑</button>
                        {{-- <button title="More" class="p-1 hover:bg-gray-100 rounded">⋮</button> --}}
                    </div>
                    <div class="relative">
                        <input type="text" placeholder="Search..."
                            class="border border-gray-200 rounded-full pl-4 pr-10 py-1 text-sm" name="search"
                            value="{{ request('search') }}">
                        <span class="absolute right-2 top-1.5 text-gray-400">🔍</span>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                    <span>Showing {{ $pesans->firstItem() }} of {{ $pesans->total() }}</span>
                    <div class="flex gap-2">
                        @if ($pesans->onFirstPage())
                        <span class="p-1 rounded text-gray-300 cursor-not-allowed">◀</span>
                        @else
                        <a href="{{ $pesans->previousPageUrl() }}"
                            class="p-1 rounded hover:bg-gray-100 active:bg-gray-200 transition duration-150 ease-in-out">◀</a>
                        @endif

                        @if ($pesans->hasMorePages())
                        <a href="{{ $pesans->nextPageUrl() }}"
                            class="p-1 rounded hover:bg-gray-100 active:bg-gray-200 transition duration-150 ease-in-out">▶</a>
                        @else
                        <span class="p-1 rounded text-gray-300 cursor-not-allowed">▶</span>
                        @endif
                    </div>
                </div>
                <hr class="mt-2">
                <!-- Message List -->
                <div class="h-96 overflow-y-auto">
                    <div class="divide-y">
                        @foreach ($pesans as $pesan)
                        @php
                        $searchTerm = request('search', '');

                        $highlight = function($text) use ($searchTerm) {
                        if (!$searchTerm || !$text) return e($text);
                        return preg_replace('/(' . preg_quote($searchTerm, '/') . ')/i', '<mark
                            class="bg-yellow-200 px-1 rounded">$1</mark>', e($text));
                        };
                        @endphp
                        <a href="{{ route('kotak-masuk.show', $pesan->id) }}" class="block">
                            <div class="flex items-center justify-between py-3 hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" name="message_ids[]" value="{{ $pesan->id }}"
                                        class="ml-2 message-checkbox" />
                                    <button data-id="{{ $pesan->id }}"
                                        class="toggle-star text-yellow-400 hover:text-yellow-300">
                                        {{ $pesan->star === 'iya' ? '★' : '☆' }}
                                    </button>
                                    <span class="font-medium text-gray-800">
                                        @if ($pesan->user)
                                        {!! $highlight($pesan->user->nama_pengguna) !!}
                                        @else
                                        {!! $highlight($pesan->nama) !!}
                                        @endif
                                    </span>
                                    <span class="text-sm text-gray-500 truncate max-w-xs">
                                        @if ($pesan->pesan)
                                        {!! $highlight(Str::limit($pesan->pesan, 100)) !!}
                                        @else
                                        {!! $highlight(Str::limit($pesan->detail_pesan, 100)) !!}
                                        @endif
                                    </span>
                                </div>

                                <div class="flex items-center gap-3">
                                    @if (\Carbon\Carbon::parse($pesan->created_at)->diffInHours(now()) < 24) <span
                                        class="text-xs bg-yellow-100 text-yellow-600 px-2 py-0.5 rounded-full">
                                        Tebaru</span>
                                        @endif

                                        @if ($pesan->status === 'laporan')
                                        <span
                                            class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full">Laporan</span>
                                        @elseif ($pesan->status === 'masukan')
                                        <span
                                            class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">Masukan</span>
                                        @endif

                                        <span class="text-sm text-black mr-2">
                                            {{ date('M j, Y') }}
                                        </span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </form>
            <script>
                document.addEventListener('click', function (e) {
                    // Use closest() so clicks on <i> inside the button also trigger this
                    const btn = e.target.closest('.delete-btn');
                    if (!btn) return; // not a delete button click

                    e.preventDefault();
                    const id = btn.getAttribute('data-id');
                    const formId = 'delete-form-' + id;
                    const form = document.getElementById(formId);

                    if (!form) {
                        console.error('Form dengan ID ' + formId + ' tidak ditemukan!');
                        return;
                    }

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        customClass: {
                            confirmButton: 'bg-red-500 text-white hover:bg-red-600 px-4 py-2 rounded',
                            cancelButton: 'bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded ml-2'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>

<script>
    // Select All Checkbox
    document.getElementById('selectAll').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.message-checkbox');
        checkboxes.forEach(box => box.checked = this.checked);
        updateHiddenInput();
    });

    // Individual Message Checkboxes
    document.querySelectorAll('.message-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateHiddenInput);
    });

    // Hidden Input Update Function
    function updateHiddenInput() {
        const selectedIds = [];
        document.querySelectorAll('.message-checkbox:checked').forEach(checkbox => {
            selectedIds.push(checkbox.value);
        });
        document.getElementById('message-ids').value = JSON.stringify(selectedIds);
    }

    // Toggle Star AJAX
    document.querySelectorAll('.toggle-star').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.dataset.id;
            fetch("{{ url('dashboard-admin/kotak-masuk/toggle-star') }}/" + id, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => response.json()).then(data => {
                this.textContent = this.textContent === '★' ? '☆' : '★';
            });
        });
    });

</script>
@endsection
