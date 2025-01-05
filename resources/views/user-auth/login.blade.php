@extends('layouts.auth-layout')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-red-600 mb-6">Login</h2>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
                {{ $errors->first('message') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="nama_pengguna" class="block text-sm font-medium text-gray-700">Nama Pengguna</label>
                <input type="text" id="nama_pengguna" name="nama_pengguna" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mt-2" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mt-2" required>
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 focus:outline-none">Login</button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a></p>
        </div>
    </div>
</div>
@endsection
