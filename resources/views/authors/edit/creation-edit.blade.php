@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-6">Edit Karya</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">{{ session('error') }}</div>
    @endif

    <form action="{{ route('karya.update', $karya->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 font-bold">Judul</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $karya->judul) }}"
                class="mt-1 p-2 w-full border rounded-md" required>
        </div>

        <!-- Creator -->
        <div class="mb-4">
            <label for="creator" class="block text-gray-700 font-bold">Penulis / Creator</label>
            <input type="text" id="creator" name="penulis" value="{{ old('penulis', $karya->creator) }}"
                class="mt-1 p-2 w-full border rounded-md" required>
        </div>

        <!-- Media -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-1">Media / Gambar</label>
            @if ($karya->media)
                <div class="mb-2">
                    <img src="data:image/jpeg;base64,{{ $karya->media }}" alt="Preview Gambar"
                        class="max-h-48 rounded border">
                </div>
            @endif
            <input type="file" name="media" accept="image/*" class="block w-full">
            <small class="text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar.</small>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 font-bold">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi"
                class="mt-1 p-2 w-full border rounded-md" rows="4">{{ old('deskripsi', $karya->deskripsi) }}</textarea>
        </div>

        <!-- Konten -->
        <div class="mb-4">
            <label for="konten" class="block text-gray-700 font-bold">Konten</label>
            <textarea id="konten" name="konten"
                class="mt-1 p-2 w-full border rounded-md" rows="4">{{ old('konten', $karya->konten) }}</textarea>
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label for="kategori" class="block text-gray-700 font-bold">Kategori</label>
            <select id="kategori" name="kategori"
                class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300" required>
                @php
                    $kategoriList = ['puisi', 'pantun', 'syair', 'fotografi', 'desain_grafis'];
                @endphp
                @foreach ($kategoriList as $kategori)
                    <option value="{{ $kategori }}" {{ $karya->kategori === $kategori ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $kategori)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Visibilitas -->
        <div class="mb-4">
            <span class="block text-sm font-bold text-gray-700">Visibilitas</span>
            <div class="mt-3 flex items-center space-x-4">
                <label class="flex items-center text-gray-700">
                    <input type="radio" name="visibilitas" value="public"
                        {{ $karya->visibilitas === 'public' ? 'checked' : '' }} required>
                    <span class="ml-2">Public</span>
                </label>
                <label class="flex items-center text-gray-700">
                    <input type="radio" name="visibilitas" value="private"
                        {{ $karya->visibilitas === 'private' ? 'checked' : '' }} required>
                    <span class="ml-2">Private</span>
                </label>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-6">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
