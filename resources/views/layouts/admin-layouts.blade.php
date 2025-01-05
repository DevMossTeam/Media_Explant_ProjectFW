<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    <!-- Tambahkan link CSS, misalnya Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
</head>
<body class="bg-gray-100">
<header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <!-- Profil Dropdown -->
        <div class="relative">
            @php
                $userUid = Cookie::get('user_uid'); // Ambil UID pengguna dari cookie
                $user = $userUid ? \App\Models\User::where('uid', $userUid)->first() : null;
            @endphp
            <button id="profileButton" class="flex items-center space-x-2 focus:outline-none">
                @if($user && $user->profile_pic)
                    <img src="{{ asset($user->profile_pic) }}" alt="Profil" class="w-8 h-8 rounded-full">
                @else
                    <i class="fa-solid fa-user-circle text-2xl"></i>
                @endif
                @if($user)
                    <span class="text-sm">{{ $user->nama_pengguna ?? 'Admin' }}</span>
                @endif
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
                    <path d="M7 10l5 5 5-5H7z" />
                </svg>
            </button>
            <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded-md hidden">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</header>
    <main class="py-6">
        @yield('content') <!-- Section yang akan diisi oleh setiap halaman -->
    </main>
    <footer class="bg-gray-800 text-white py-4 mt-10">
        <div class="container mx-auto px-4 text-center">
            &copy; 2025 Dashboard Admin. All Rights Reserved.
        </div>
    </footer>

    <script>
        // Toggle untuk dropdown profil
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        profileButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Hentikan propagasi klik ke elemen lain
            profileDropdown.classList.toggle('hidden');
        });

        // Tutup dropdown ketika klik di luar
        document.addEventListener('click', (e) => {
            if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>

    <!-- Tambahkan FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
