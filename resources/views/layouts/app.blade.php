<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persma</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/dev-64.png') }}" type="image/png">
</head>
<body class="bg-gray-100">
    <!-- Header -->
    @include('header-footer.header')

    <!-- Konten Utama -->
    @yield('content')

    <!-- Footer -->
    @include('header-footer.footer')
</body>
</html>
