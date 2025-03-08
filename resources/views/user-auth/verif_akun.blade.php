@extends('layouts.auth-layout')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-red-600 mb-6">Verifikasi Akun</h2>

        @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <p class="text-sm text-gray-600 text-center mb-4">
            Masukkan kode OTP yang dikirim ke email Anda.
        </p>

        <form action="{{ route('verifikasi-akun') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="otp" class="block text-sm font-medium text-gray-700">Kode OTP</label>
                <input type="text" id="otp" name="otp"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mt-2 text-center text-xl tracking-widest"
                    maxlength="6" pattern="[0-9]{6}" required>
            </div>

            <button type="submit"
                class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition">
                Verifikasi
            </button>
        </form>
    </div>
</div>
@endsection
