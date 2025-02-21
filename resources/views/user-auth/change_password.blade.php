<link rel="shortcut icon" href="{{ asset('assets/ukpm-explant-ic.png') }}" type="image/png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@extends('layouts.auth-layout')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-red-600 mb-6">Ganti Password</h2>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.updatePassword') }}" method="POST">
            @csrf
            <div class="mb-6 relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password baru" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mt-2 pr-10" required>
                <span class="absolute right-4 top-[70%] transform -translate-y-1/2 cursor-pointer text-gray-600 hover:text-gray-900" onclick="togglePassword('password', 'eyeIcon1')">
                    <i id="eyeIcon1" class="fa fa-eye"></i>
                </span>
            </div>

            <div class="mb-6 relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password baru" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mt-2 pr-10" required>
                <span class="absolute right-4 top-[70%] transform -translate-y-1/2 cursor-pointer text-gray-600 hover:text-gray-900" onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                    <i id="eyeIcon2" class="fa fa-eye"></i>
                </span>
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 focus:outline-none">Ganti Password</button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-red-600 hover:underline">
                Kembali ke Menu Login
            </a>
        </div>
    </div>
</div>

<!-- Script untuk toggle password visibility -->
<script>
    function togglePassword(inputId, iconId) {
        const passwordField = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>
@endsection
