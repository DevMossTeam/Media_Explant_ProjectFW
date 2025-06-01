@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-4 py-6">    
    <div class="mb-6">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-gray-500 space-x-2" aria-label="Breadcrumb">
            <a href="/dashboard-admin" class="flex items-center text-gray-600 hover:text-blue-600 transition">
                <i class="fa-solid fa-house mr-1"></i>
                <span>Home</span>
            </a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-700 font-medium">Analitk Konten</span>
        </nav>

        <!-- Title and Button in the same line -->
        <div class="flex justify-between items-center mt-3">
            <h1 class="text-2xl font-bold text-gray-800">Analitik Konten</h1>
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                <i class="fa-solid fa-download mr-2"></i>Download Laporan
            </button>
        </div>
    </div>
    <div class="rounded-lg shadow-md flex flex-col h-[400px] mb-4 rounded-sm bg-white overflow-hidden w-full">
        <!-- Header: Title and Date Select -->
        <div class="flex justify-between items-center px-4 py-2">
            <!-- Left Side: Title -->
            <div class="flex items-center space-x-2">
                <h2 class="text-xl font-bold text-gray-700">Grafik</h2>
                <!-- Icon (if present) -->
                {{-- <i class="fas fa-info-circle text-gray-500 ml-2"></i> <!-- Example icon --> --}}
            </div>

            <!-- Right Side: Select Dropdown -->
            {{-- <select class="border rounded-xl pr-10 py-1 text-gray-600">
                <option>7 hari ini</option>
                <option>Bulan ini</option>
                <option>Tahun ini</option>
            </select> --}}
        </div>
        <div class="flex-grow relative">
            <canvas id="chart1-area" class="w-full max-h-80 max-w-full px-10 mt-10"></canvas>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <!-- Left Side: KOTAK PESAN -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-4 h-96 flex flex-col justify-between">
                <!-- Header -->
                <div class="flex items-center space-x-2">
                    <h2 class="text-xl font-bold text-gray-700">Tingkat keterlibatan Konten Per Click </h2>
                    <!-- Icon (if present) -->
                    <i class="fas fa-info-circle text-gray-500 ml-2"></i> <!-- Example icon -->
                </div>

            </div>
        </div>
        <!-- Right Side -->
        <div class="grid grid-rows-2 gap-4">
            <!-- Card 1: Analitik Pengunjung -->
            <div class="bg-gray-500  rounded-lg shadow-md p-4 flex flex-col justify-between">


            </div>

            <!-- Card 2: Analitik Konten -->
            <div class="bg-white rounded-lg shadow-md p-4 flex flex-col justify-between">
            </div>
        </div>
    </div>
    <!-- Most Search  -->
    {{-- <div class="rounded-lg shadow-md flex flex-col h-full mb-4 rounded-sm bg-white overflow-hidden w-full">
        <!-- Header: Title and Date Select -->
        <div class="flex justify-between items-center px-4 py-2">
            <h2 class="text-xl font-bold text-gray-700 my-5">Konten dengan performa terbaik</h2>
            <select class="border rounded-xl pr-10 py-1 text-gray-600">
                <option>7 hari ini</option>
                <option>Bulan ini</option>
                <option>Tahun ini</option>
            </select>
        </div>
        <!-- Chart Container -->
        <div class="flex-grow relative">
            <h2 class="text-xl font-bold text-gray-700 my-5">Berita</h2>
            <div class="flex items-start space-x-4">
                <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt=""
                    class="w-24 h-auto rounded-sm object-cover" />
                <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                    Memahami Payung Hukum dan
                    Perlindungan Pers Mahasiswa.
                </p>
            </div>
            <h2 class="text-xl font-bold text-gray-700 my-5">Produk</h2>
            <div class="flex items-start space-x-4">
                <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt=""
                    class="w-24 h-auto rounded-sm object-cover" />
                <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                    Memahami Payung Hukum dan
                    Perlindungan Pers Mahasiswa.
                </p>
            </div>
            <h2 class="text-xl font-bold text-gray-700 my-5">Karya</h2>
            <div class="flex items-start space-x-4">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s"
                    alt="" class="w-24 h-auto rounded-sm object-cover" />
                <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                    Memahami Payung Hukum dan
                    Perlindungan Pers Mahasiswa.
                </p>
            </div>
        </div>
    </div> --}}
    <!-- Content Terpopular -->
    <h2 class="text-xl font-bold text-gray-700 my-5">Konten dengan performa terbaik</h2>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

    </style>
    <!-- Etalase Terpopular -->
    {{-- <div class="bg-white rounded-lg shadow-md p-4 mb-4">
        <div class="text-xl font-semibold mb-4">Etalase Terpopular</div>
        <div class="overflow-x-auto whitespace-nowrap space-x-4 pb-2">
            @foreach ($etalases as $etalase)
            <div class="inline-block w-64 align-top bg-white rounded shadow-sm p-2 hover:shadow">
                <img src="{{ $etalase->image }}" alt="{{ $etalase->title }}"
                    class="w-full h-32 object-cover rounded-sm mb-2">
                <p class="text-lg text-gray-700 hover:text-gray-900 cursor-pointer line-clamp-2">
                    {{ $etalase->title }}
                </p>
            </div>
            @endforeach
        </div>
    </div> --}}

    <!-- Karya Terpopular -->
    {{-- <div class="bg-white rounded-lg shadow-md p-4 mb-4">
        <div class="text-xl font-semibold mb-4">Karya Terpopular</div>
        <div class="overflow-x-auto whitespace-nowrap space-x-4 pb-2">
            @foreach ($karyas as $karya)
            <div class="inline-block w-64 align-top bg-white rounded shadow-sm p-2 hover:shadow">
                <img src="{{ $karya->cover }}" alt="{{ $karya->title }}"
                    class="w-full h-32 object-cover rounded-sm mb-2">
                <p class="text-lg text-gray-700 hover:text-gray-900 cursor-pointer line-clamp-2">
                    {{ $karya->title }}
                </p>
            </div>
            @endforeach
        </div>
    </div> --}}
    {{-- <!-- Third grid: 2 columns (responsive: 1 column on small, 2 columns on md and up) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400">+</p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400">+</p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400">+</p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400">+</p>
        </div>
    </div>

    <!-- Fourth section: Full-width block remains as is -->
    <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50">
        <p class="text-2xl text-gray-400">+</p>
    </div>

    <!-- Fifth grid: 2 columns (responsive: 1 column on small, 2 columns on md and up) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400">1</p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400">2</p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400">3</p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400">4</p>
        </div>
    </div> --}}
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const canvas = document.getElementById('chart1-area');
        const ctx = canvas.getContext('2d');

        // Gradients
        const gradientBlue = ctx.createLinearGradient(0, 0, 0, canvas.height);
        gradientBlue.addColorStop(0, 'rgba(54, 162, 235, 0.6)');
        gradientBlue.addColorStop(1, 'rgba(54, 162, 235, 0.1)');

        const gradientOrange = ctx.createLinearGradient(0, 0, 0, canvas.height);
        gradientOrange.addColorStop(0, 'rgba(255, 159, 64, 0.6)');
        gradientOrange.addColorStop(1, 'rgba(255, 159, 64, 0.1)');
        // Sample Data
        const labels = ['Mei 26', 'Mei 27', 'Mei 28', 'Mei 29', 'Mei 30', 'Mei 31', 'Juni 1'];
        const dataBlue = [10, 5, 7, 7, 13, 18, 22];
        const dataOrange = [10, 6, 9, 5, 15, 20, 20];

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Pengunjung',
                        data: dataBlue,
                        tension: 0.4,
                        fill: true,
                        backgroundColor: gradientBlue,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)'
                    },
                    {
                        label: 'Pengunjung (periode sebelumnya)',
                        data: dataOrange,
                        tension: 0.4,
                        fill: true,
                        backgroundColor: gradientOrange,
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgba(255, 159, 64, 1)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        intersect: false
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    x: {
                        grid: {
                            // display: false,
                            // drawBorder: true
                        }
                    },
                    y: {
                        // display: false,
                        // grid: {
                        //     display: false
                        // }
                    }
                }
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const counters = document.querySelectorAll('.counter-number-animation');

        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            let count = 0;
            const speed = 100; // Semakin kecil, semakin cepat

            const updateCount = () => {
                const increment = Math.ceil(target / speed);
                count += increment;

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
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('
            success ') }}',
            timer: 3000, // auto close 3 detik
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#3b82f6', // warna biru Tailwind 'blue-500'
            buttonsStyling: false,
            customClass: {
                confirmButton: 'bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded'
            }
        });
    });

</script>
@endif
@endsection
