<link rel="shortcut icon" href="{{ asset('assets/dev-64.png') }}" type="image/png">
@extends('layouts.auth-layout')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-red-600 mb-6">Verifikasi OTP</h2>

        @if (session('status'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('password.verifyOtp') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="otp" class="block text-sm font-medium text-gray-700">Kode OTP</label>
                <input
                    type="text"
                    id="otp"
                    name="otp"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mt-2"
                    maxlength="6"
                    pattern="[0-9]{6}"
                    title="Masukkan kode OTP 6 digit angka"
                    required>
            </div>

            <button
                type="submit"
                class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 focus:outline-none">
                Verifikasi
            </button>
        </form>
    </div>
</div>
@endsection