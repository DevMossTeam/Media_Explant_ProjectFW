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
    <div class="rounded-lg shadow-md flex flex-col h-full mb-4 rounded-sm bg-white overflow-hidden w-full">
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
    </div>
    <!-- Content Terpopular -->
    <h2 class="text-xl font-bold text-gray-700 my-5">Konten dengan performa terbaik</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 ">
        <div class="flex flex-col h-96 rounded-lg shadow-md bg-white p-4">
            <div class="text-xl font-semibold mb-4">Berita Terpopular</div>
            <div class="overflow-auto flex-1">
                <div class="flex items-start space-x-4">
                    <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Memahami Payung Hukum dan
                        Perlindungan Pers Mahasiswa.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">Majelis Hakim Tidak Progresif
                        dalam
                        Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.</p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">Majelis Hakim Tidak Progresif
                        dalam
                        Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.</p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">Majelis Hakim Tidak Progresif
                        dalam
                        Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.</p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://www.persma.id/wp-content/uploads/2024/09/1-696x557.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">Majelis Hakim Tidak Progresif
                        dalam
                        Memahami Legal Standing Penggugat dalam Gugatan Pembekuan Lembaga Pers Mahasiswa Lintas.</p>
                </div>
                <!-- Tambahkan lebih banyak konten di sini -->
            </div>
        </div>

        <div class="flex flex-col h-96 rounded-lg shadow-md bg-white p-4">
            <div class="text-xl font-semibold mb-4">Etalase Terpopular</div>
            <div class="overflow-auto flex-1">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Memahami Payung Hukum dan
                        Perlindungan Pers Mahasiswa.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://ebooks.gramedia.com/ebook-covers/50298/image_highres/ID_AW2020MTH01AW.jpg" alt=""
                        class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <!-- Tambahkan lebih banyak konten di sini -->
            </div>
        </div>
        <div class="flex flex-col h-96 rounded-lg shadow-md bg-white p-4">
            <div class="text-xl font-semibold mb-4">Karya Terpopular</div>
            <div class="overflow-auto flex-1">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s"
                        alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Memahami Payung Hukum dan
                        Perlindungan Pers Mahasiswa.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s"
                        alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s"
                        alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s"
                        alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s"
                        alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s"
                        alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex items-start space-x-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTflVfITKyWM-oRurgCWuo8IKuC__b-D462Ig&s"
                        alt="" class="w-24 h-auto rounded-sm object-cover" />
                    <p class="text-2xl cursor-pointer text-gray-500 hover:text-gray-800">
                        Majelis Hakim Tidak Progresif dalam Memahami Legal Standing Penggugat dalam Gugatan Pembekuan
                        Lembaga Pers Mahasiswa Lintas.
                    </p>
                </div>
                <!-- Tambahkan lebih banyak konten di sini -->
            </div>
        </div>
    </div>
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
    </div>
</div>
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
