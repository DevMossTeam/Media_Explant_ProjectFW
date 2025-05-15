<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800">

    <!-- Header -->
    <div class="flex items-center px-6 py-4 border-b">
        <a href="{{ session('settings_previous_url', url('/')) }}" class="flex items-center">
            <img src="{{ asset('assets/Medex-M-IC.png') }}" alt="Logo" class="w-6 h-6 mr-2">
            <h1 class="text-lg font-semibold text-red-600">Pengaturan</h1>
        </a>
    </div>

    <!-- Layout -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-60 bg-gray-100 p-4 flex flex-col gap-4 border-r">
            <a href="{{ route('settings.umum') }}" class="flex items-center gap-2 text-gray-600 hover:text-blue-600">
                <i class="fas fa-user"></i> Akun
            </a>
            <a href="{{ route('settings.notifikasi') }}"
                class="flex items-center gap-2 text-gray-600 hover:text-blue-600">
                <i class="fas fa-bell"></i> Notifikasi
            </a>
            <a href="{{ route('settings.bantuan') }}" class="flex items-center gap-2 text-gray-600 hover:text-blue-600">
                <i class="fas fa-question-circle"></i> Pusat Bantuan
            </a>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-y-auto">
            @yield('setting-content')
        </div>
    </div>

</body>

</html>
