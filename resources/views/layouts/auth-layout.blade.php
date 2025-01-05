<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persma</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
</head>
<body class="bg-gray-100">
    <!-- Konten Utama (hanya konten yang di-extend) -->
    @yield('content')
</body>
</html>
