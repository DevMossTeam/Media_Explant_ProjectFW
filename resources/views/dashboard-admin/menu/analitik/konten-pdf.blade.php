<!DOCTYPE html>
<html>
<head>
    <title>Laporan Analitik Konten</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 90%; margin: 0 auto; }
        .card { border: 1px solid #ddd; margin: 20px 0; padding: 20px; }
        .counter-card { display: inline-block; width: 30%; text-align: center; border-radius: 8px; background: #f9f9f9; padding: 20px; margin: 10px; }
        .chart { height: 400px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Analitik Konten</h1>
        <p>Periode: {{ $period == '7_hari' ? '7 Hari Ini' : ($period == 'bulan' ? 'Bulan Ini' : 'Tahun Ini') }}</p>

        <!-- Counter Cards -->
        <div class="flex flex-wrap justify-center">
            <div class="counter-card bg-blue-50">
                <i class="fa-solid fa-thumbs-up text-3xl text-blue-500"></i>
                <p class="mt-2">Total Like</p>
                <p class="text-3xl font-bold">{{ $totalLike }}</p>
            </div>
            <div class="counter-card bg-red-50">
                <i class="fa-solid fa-thumbs-down text-3xl text-red-500"></i>
                <p class="mt-2">Total Dislike</p>
                <p class="text-3xl font-bold">{{ $totalDislike }}</p>
            </div>
            <div class="counter-card bg-yellow-50">
                <i class="fa-solid fa-comments text-3xl text-yellow-500"></i>
                <p class="mt-2">Total Komentar</p>
                <p class="text-3xl font-bold">{{ $totalKomentar }}</p>
            </div>
        </div>

        <!-- Charts -->
        @foreach(['Berita', 'Karya', 'Produk'] as $chartType)
            <div class="card">
                <h2>Grafik {{ $chartType }}</h2>
                <div class="chart">
                    <!-- Static Chart Representation -->
                    <img src="{{ asset('images/chart-placeholder.png') }}" alt="Grafik {{ $chartType }}">
                </div>
            </div>
        @endforeach

        <div class="card">
            <h2>Engagement</h2>
            <div class="chart">
                <!-- Static Chart Representation -->
                <img src="{{ asset('images/engagement-placeholder.png') }}" alt="Engagement">
            </div>
        </div>
    </div>
</body>
</html>