@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <!-- Judul Halaman -->
    <h1 class="text-3xl font-bold text-blue-600 text-center mb-4">Pusat Bantuan</h1>
    <p class="text-gray-700 text-center mb-6">
        Cari jawaban dari pertanyaan yang sering diajukan atau hubungi tim dukungan kami.
    </p>

    <!-- Kolom Pencarian -->
    <div class="mb-6">
        <input type="text" name="search" placeholder="Cari bantuan..." class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
    </div>

    <!-- FAQ -->
    <section class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Pertanyaan yang Sering Diajukan</h2>
        
        <details class="mb-4 bg-white rounded-lg p-4 shadow">
            <summary class="cursor-pointer font-medium text-lg text-gray-800">
                Bagaimana cara mendaftar akun?
            </summary>
            <p class="mt-2 text-gray-700">
                Untuk mendaftar akun, Anda dapat mengklik tombol "Daftar" di halaman login dan mengisi formulir pendaftaran dengan data yang valid.
            </p>
        </details>

        <details class="mb-4 bg-white rounded-lg p-4 shadow">
            <summary class="cursor-pointer font-medium text-lg text-gray-800">
                Bagaimana cara mereset password?
            </summary>
            <p class="mt-2 text-gray-700">
                Jika Anda lupa password, klik "Lupa Password?" di halaman login, lalu ikuti petunjuk untuk reset password melalui email Anda.
            </p>
        </details>

        <details class="mb-4 bg-white rounded-lg p-4 shadow">
            <summary class="cursor-pointer font-medium text-lg text-gray-800">
                Bagaimana cara mengubah profil saya?
            </summary>
            <p class="mt-2 text-gray-700">
                Anda dapat mengubah informasi profil melalui menu "Profil" di dalam aplikasi, lalu pilih "Edit Profil" dan simpan perubahan Anda.
            </p>
        </details>

        <details class="mb-4 bg-white rounded-lg p-4 shadow">
            <summary class="cursor-pointer font-medium text-lg text-gray-800">
                Apa yang harus dilakukan jika aplikasi mengalami error?
            </summary>
            <p class="mt-2 text-gray-700">
                Jika aplikasi mengalami error, coba restart aplikasi terlebih dahulu. Jika masih berlanjut, hubungi tim dukungan kami melalui halaman "Hubungi Kami".
            </p>
        </details>

        <details class="mb-4 bg-white rounded-lg p-4 shadow">
            <summary class="cursor-pointer font-medium text-lg text-gray-800">
                Bagaimana cara menghubungi tim support?
            </summary>
            <p class="mt-2 text-gray-700">
                Anda dapat menghubungi tim support melalui halaman "Hubungi Kami" atau mengirim email ke support@aplikasi.com.
            </p>
        </details>
    </section>

    <!-- Tombol Hubungi Dukungan -->
    <div class="text-center">
        <a href="{{ url('/hubungi') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
            Hubungi Tim Dukungan
        </a>
    </div>
</div>
@endsection
