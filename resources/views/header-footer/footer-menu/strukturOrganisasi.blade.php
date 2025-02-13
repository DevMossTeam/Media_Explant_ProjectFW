@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-red-600 mb-4">Struktur Organisasi</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach (['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Koordinator Media', 'Koordinator Publikasi', 'Koordinator Lapangan', 'Anggota'] as $role)
        <div class="bg-white p-4 rounded-lg shadow-md text-center">
            <h2 class="text-lg font-bold">{{ $role }}</h2>
            <p class="text-gray-600">Anonym {{ $loop->iteration }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
