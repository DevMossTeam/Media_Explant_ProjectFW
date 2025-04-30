@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Detail Berita</h1>
        <nav aria-label="Breadcrumb" class="text-sm text-gray-500">
            <ol class="list-reset flex items-center">
                <li class="flex items-center group text-gray-600 hover:text-black">
                    <i class="fa-solid fa-home mr-1 transition"></i>
                    <a href="/dashboard-admin" class="transition ml-1">Home</a>
                </li>
                <li><span class="mx-2 text-gray-500">></span></li>
                <li class="flex items-center group text-gray-600 hover:text-black">
                    <a href="/dashboard-admin/berita" class="transition">Berita</a>
                </li>
                <li><span class="mx-2 text-gray-500">></span></li>
                <li class="text-gray-700">Detail</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="bg-white shadow rounded-lg p-6">
        <!-- Hero Section -->
        <div class="mb-6">
            <h2 class="text-3xl font-bold mb-2">{{ $beritas->judul }}</h2>
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm text-gray-500">
                    Oleh: {{ $beritas->user->nama_lengkap }} - 
                    {{ date('d M Y - H:i', strtotime($beritas->tanggal_diterbitkan)) }}
                </div>                
            </div>
            @if ($beritas->cover_image)
                <img src="{{ asset($beritas->cover_image) }}" alt="Cover Image"
                     class="w-full h-64 object-cover rounded-lg mb-4">
            @endif
        </div>

        <!-- Metadata -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <strong>Tanggal Diterbitkan:</strong> {{ date('d M Y - H:i', strtotime($beritas->tanggal_diterbitkan)) }}
            </div>
            <div>
                <strong>View Count:</strong> {{ $beritas->view_count }}
            </div>
            <div>
                <strong>Kategori:</strong> {{ $beritas->kategori }}
            </div>
            <div>
                <strong>Visibilitas:</strong> {{ $beritas->visibilitas }}
            </div>
        </div>

        <!-- Konten Berita -->
        <div class="prose max-w-none mb-6">
            <strong>Konten Berita:</strong>
            {!! $beritas->konten_berita !!}
        </div>

        <!-- Penulis -->
        <div class="mb-4">
            <strong>Penulis:</strong> {{ $beritas->user->nama_lengkap }}
        </div>

        <!-- Action Button -->
        <a href="{{ route('news.detail', $beritas->id) }}" class="text-blue-600 hover:underline">
            Lihat Detail
        </a>
    </div>
</div>
@endsection