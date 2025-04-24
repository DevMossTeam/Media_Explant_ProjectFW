@extends('layouts.admin-layouts')

@section('content')
<div class="container mx-auto px-1 py-1">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <!-- Card Container -->
        <div class="relative flex items-center justify-between rounded-lg bg-white h-28 shadow-md p-4">
            <div>
                <p class="text-sm text-gray-500">Total Pengguna</p>
                <p class="text-2xl font-bold counter-number-animation" data-target="25"></p>
            </div>
            <i
                class="fa-solid fa-user absolute top-2 right-2 text-xl text-gray-500 bg-gray-100 p-2 rounded-lg shadow-sm"></i>
        </div>
        <div class="relative flex items-center justify-between rounded-lg bg-white h-28 shadow-md p-4">
            <div>
                <p class="text-sm text-gray-500">Total Berita</p>
                <p class="text-2xl font-bold counter-number-animation" data-target="100">0</p>
            </div>
            <i
                class="fa-solid fa-newspaper absolute top-2 right-2 text-xl text-gray-500 bg-gray-100 p-2 rounded-lg shadow-sm"></i>
        </div>
        <div class="relative flex items-center justify-between rounded-lg bg-white h-28 shadow-md p-4">
            <div>
                <p class="text-sm text-gray-500">Total Produk</p>
                <p class="text-2xl font-bold counter-number-animation" data-target="1000">0</p>
            </div>
            <i
                class="fa-solid fa-cube absolute top-2 right-2 text-xl text-gray-500 bg-gray-100 p-2 rounded-lg shadow-sm"></i>
        </div>
        <div class="relative flex items-center justify-between rounded-lg bg-white h-28 shadow-md p-4">
            <div>
                <p class="text-sm text-gray-500">Total Karya</p>
                <p class="text-2xl font-bold counter-number-animation" data-target="75">0</p>
            </div>
            <i
                class="fa-solid fa-book absolute top-2 right-2 text-xl text-gray-500 bg-gray-100 p-2 rounded-lg shadow-sm"></i>
        </div>
    </div>
    <!-- Total Pengungjung  -->
    <div class="rounded-lg shadow-md flex flex-col h-[500px] mb-4 rounded-sm bg-white overflow-hidden w-full">
        <!-- Header: Title and Date Select -->
        <div class="flex justify-between items-center px-4 py-2">
            <h2 class="text-xl font-bold text-gray-700">Total Pengunjung</h2>
            <select class="border rounded px-3 py-1 text-gray-600">
                <option>Dec 31 – Jan 31</option>
                <option>Feb 1 – Feb 28</option>
                <option>Mar 1 – Mar 31</option>
            </select>
        </div>
        <!-- Chart Container -->
        <div class="flex-grow relative">
            <canvas id="chart1-area" class="w-full max-h-80 max-w-full px-10 mt-10"></canvas>
        </div>
    </div>

    <!-- Most Search  -->
    {{-- <div class="rounded-lg shadow-md flex flex-col h-[500px] mb-4 rounded-sm bg-white overflow-hidden w-full">
        <!-- Header: Title and Date Select -->
        <div class="flex justify-between items-center px-4 py-2">
            <h2 class="text-xl font-bold text-gray-700">Topic Paling Dicari </h2>
            <select class="border rounded px-3 py-1 text-gray-600">
            <option>Dec 31 – Jan 31</option>
            <option>Feb 1 – Feb 28</option>
            <option>Mar 1 – Mar 31</option>
        </select>
        </div>
        <!-- Chart Container -->
        <div class="flex-grow relative">
            <canvas id="chart1-area" class="w-full max-h-80 max-w-full px-10 mt-10"></canvas>
        </div>
    </div> --}}
    <!-- Content Terpopular -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 ">
        <div class="flex flex-col h-96 rounded-lg shadow-md bg-white p-4">
            <div class="text-xl font-semibold mb-4">Berita Terpopular</div>
            <div class="overflow-auto flex-1">
                <div class="flex items-start space-x-4">
                    <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Memahami Payung Hukum dan
                            Perlindungan Pers Mahasiswa.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">Majelis Hakim Tidak Progresif dalam
                    Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.</p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">Majelis Hakim Tidak Progresif dalam
                    Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.</p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">Majelis Hakim Tidak Progresif dalam
                    Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.</p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">Majelis Hakim Tidak Progresif dalam
                    Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.</p>
                </div>
                <!-- Tambahkan lebih banyak konten di sini -->
            </div>
        </div>

        <div class="flex flex-col h-96 rounded-lg shadow-md bg-white p-4">
            <div class="text-xl font-semibold mb-4">Etalase Terpopular</div>
            <div class="overflow-auto flex-1">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Memahami Payung Hukum dan
                            Perlindungan Pers Mahasiswa.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <!-- Tambahkan lebih banyak konten di sini -->
            </div>
        </div>
        <div class="flex flex-col h-96 rounded-lg shadow-md bg-white p-4">
            <div class="text-xl font-semibold mb-4">Karya Terpopular</div>
            <div class="overflow-auto flex-1">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Memahami Payung Hukum dan
                            Perlindungan Pers Mahasiswa.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div> <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s" alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <!-- Tambahkan lebih banyak konten di sini -->
            </div>
        </div>
    </div>
{{-- 
    <!-- Third grid: 2 columns (responsive: 1 column on small, 2 columns on md and up) -->
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



<!-- Chart.js Setup -->
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
        const labels = ['Mar 1', 'Mar 2', 'Mar 3', 'Mar 4', 'Mar 5', 'Mar 6', 'Mar 7'];
        const dataBlue = [50, 60, 45, 70, 55, 80, 90];
        const dataOrange = [45, 50, 60, 55, 65, 60, 85];

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
                        label: 'Pengunjung (previous period)',
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
                            display: false,
                            drawBorder: true
                        }
                    },
                    y: {
                        display: false,
                        grid: {
                            display: false
                        }
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
@endsection
