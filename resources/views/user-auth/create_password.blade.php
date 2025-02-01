<link rel="shortcut icon" href="{{ asset('assets/dev-64.png') }}" type="image/png">
@extends('layouts.auth-layout')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-red-600 mb-6">Buat Password</h2>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <p class="text-sm text-gray-600 text-center mb-4">
            Silakan buat password baru untuk akun Anda.
        </p>

        <form action="{{ route('store-password') }}" method="POST">
            @csrf

            <!-- Password Baru -->
            <div class="mb-6 relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" id="password" name="password" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mt-2 pr-10" required>
                <span class="absolute right-3 top-10 cursor-pointer text-gray-500" onclick="togglePassword('password', 'eyeIcon1')">
                    <i id="eyeIcon1" class="fas fa-eye"></i>
                </span>
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6 relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mt-2 pr-10" required>
                <span class="absolute right-3 top-10 cursor-pointer text-gray-500" onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                    <i id="eyeIcon2" class="fas fa-eye"></i>
                </span>
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition">Simpan Password</button>
        </form>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        let input = document.getElementById(inputId);
        let icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

<!-- Tambahkan FontAwesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
