@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-center mb-6">Buletin</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow-md rounded-lg p-4">
            <img src="https://via.placeholder.com/300" alt="Buletin" class="w-full rounded-md">
            <h2 class="text-xl font-semibold mt-4">Judul Buletin</h2>
            <p class="text-gray-600">Deskripsi singkat tentang buletin ini.</p>
        </div>
    </div>
</div>
@endsection
