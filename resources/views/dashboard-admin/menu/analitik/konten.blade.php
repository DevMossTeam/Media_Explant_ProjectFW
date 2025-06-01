@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Breadcrumb & Header -->
    <div class="mb-6">
        <nav class="flex items-center text-sm text-gray-500 space-x-2" aria-label="Breadcrumb">
            <a href="/dashboard-admin" class="flex items-center text-gray-600 hover:text-blue-600 transition">
                <i class="fa-solid fa-house mr-1"></i>
                <span>Home</span>
            </a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-700 font-medium">Analitik Konten</span>
        </nav>

        <div class="flex justify-between items-center mt-3">
            <h1 class="text-2xl font-bold text-gray-800">Analitik Konten</h1>
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                <i class="fa-solid fa-download mr-2"></i>Download Laporan
            </button>
        </div>
    </div>

    <!-- Time Filter Dropdown -->
    <div class="text-right my-5">
        <select id="timeFilter" class="border rounded-xl pr-10 py-1 text-gray-600">
            <option value="7_hari" {{ $period == '7_hari' ? 'selected' : '' }}>7 hari ini</option>
            <option value="bulan" {{ $period == 'bulan' ? 'selected' : '' }}>Bulan ini</option>
            <option value="tahun" {{ $period == 'tahun' ? 'selected' : '' }}>Tahun ini</option>
        </select>
    </div>

    <!-- Counter Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <!-- Like Counter -->
        <div class="relative flex items-center rounded-lg bg-white h-28 shadow-md p-4">
            <i class="fa-solid fa-thumbs-up text-3xl text-blue-500 bg-blue-100 p-3 rounded-lg shadow-sm mr-4"></i>
            <div>
                <p class="text-sm text-gray-500">Total Like</p>
                <p class="text-2xl font-bold counter-number-animation" data-target="{{ $totalLike }}">
                    {{ $totalLike }}
                </p>
            </div>
        </div>

        <!-- Dislike Counter -->
        <div class="relative flex items-center rounded-lg bg-white h-28 shadow-md p-4">
            <i class="fa-solid fa-thumbs-down text-3xl text-red-500 bg-red-100 p-3 rounded-lg shadow-sm mr-4"></i>
            <div>
                <p class="text-sm text-gray-500">Total Dislike</p>
                <p class="text-2xl font-bold counter-number-animation" data-target="{{ $totalDislike }}">
                    {{ $totalDislike }}
                </p>
            </div>
        </div>

        <!-- Comment Counter -->
        <div class="relative flex items-center rounded-lg bg-white h-28 shadow-md p-4">
            <i class="fa-solid fa-comments text-3xl text-yellow-500 bg-yellow-100 p-3 rounded-lg shadow-sm mr-4"></i>
            <div>
                <p class="text-sm text-gray-500">Total Komentar</p>
                <p class="text-2xl font-bold counter-number-animation" data-target="{{ $totalKomentar }}">
                    {{ $totalKomentar }}
                </p>
            </div>
        </div>
    </div>

    <!-- Content Charts -->
    @foreach(['Berita', 'Karya', 'Produk'] as $chartType)
    <div class="rounded-lg shadow-md flex flex-col h-[400px] mb-4 bg-white overflow-hidden w-full">
        <div class="flex justify-between items-center px-4 py-2">
            <h2 class="text-xl font-bold text-gray-700">Grafik {{ $chartType }}</h2>
        </div>
        <div class="flex-grow relative">
            <canvas id="chart{{ $chartType }}" class="w-full max-h-80 px-10 mt-10"></canvas>
        </div>
    </div>
    @endforeach

    <!-- Engagement Chart -->
    <div class="rounded-lg shadow-md flex flex-col h-[400px] mb-4 bg-white overflow-hidden w-full">
        <div class="flex justify-between items-center px-4 py-2">
            <h2 class="text-xl font-bold text-gray-700">Engagement</h2>
        </div>
        <div class="flex-grow relative">
            <canvas id="engagementChart" class="w-full max-h-80 px-10 mt-10"></canvas>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
<script>
// Dropdown functionality
document.getElementById('timeFilter').addEventListener('change', function() {
    const selectedPeriod = this.value;
    window.location.href = '/dashboard-admin/analitik/konten?period=' + selectedPeriod;
});

// Chart.js Configuration
document.addEventListener('DOMContentLoaded', function () {
    // Engagement Chart
    const engagementCtx = document.getElementById('engagementChart').getContext('2d');
    
    const labels = @json(collect($likePerTanggal)->pluck('tanggal'));
    const likes = @json(collect($likePerTanggal)->pluck('total'));
    const dislikes = @json(collect($dislikePerTanggal)->pluck('total'));

    new Chart(engagementCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Likes (Suka)',
                data: likes,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)'
            }, {
                label: 'Dislikes (Tidak Suka)',
                data: dislikes,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                x: { grid: { display: false } },
                y: { beginAtZero: true }
            }
        }
    });

    // Content Charts
    const chartData = {
        Berita: @json($beritaPerTanggal),
        Karya: @json($karyaPerTanggal),
        Produk: @json($produkPerTanggal),
    };

    Object.entries(chartData).forEach(([chartName, data]) => {
        const ctx = document.getElementById(`chart${chartName}`).getContext('2d');
        const labels = data.map(item => item.tanggal);
        const values = data.map(item => item.total);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: `${chartName} Terbit`,
                    data: values,
                    borderColor: 'rgb(46, 164, 79)',
                    backgroundColor: 'rgba(46, 164, 79, 0.2)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgb(46, 164, 79)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true }
                }
            }
        });
    });

    // Counter Animation
    const counters = document.querySelectorAll('.counter-number-animation');
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        let count = 0;
        const speed = Math.max(1, Math.ceil(target / 100));

        const updateCount = () => {
            count += speed;
            if (count < target) {
                counter.textContent = count.toLocaleString();
                requestAnimationFrame(updateCount);
            } else {
                counter.textContent = target.toLocaleString();
            }
        };

        updateCount();
    });
});
</script>
@endsection