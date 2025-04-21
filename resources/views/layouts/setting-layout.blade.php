<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pengaturan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-60 bg-gray-100 p-4 flex flex-col gap-4 border-r">
        <a href="{{ route('settings.umum') }}" class="flex items-center gap-2 text-gray-700 font-semibold hover:text-red-600">
            <i class="fas fa-user"></i> Akun
        </a>
        <a href="{{ route('settings.notifikasi') }}" class="flex items-center gap-2 text-gray-700 font-semibold hover:text-red-600">
            <i class="fas fa-bell"></i> Notifikasi
        </a>
        <a href="{{ route('settings.bantuan') }}" class="flex items-center gap-2 text-gray-700 font-semibold hover:text-red-600">
            <i class="fas fa-question-circle"></i> Pusat Bantuan
        </a>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 overflow-y-auto">
        @yield('content')
    </div>
</div>

</body>
</html>
