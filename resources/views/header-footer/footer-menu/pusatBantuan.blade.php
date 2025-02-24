@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-gray-100 rounded-lg shadow-xl max-w-5xl">
  <!-- Header -->
  <header class="mb-8">
    <h1 class="text-4xl font-extrabold text-red-600 text-center mb-4">Pusat Bantuan</h1>
    <p class="text-gray-700 text-center text-lg mb-6">
      Temukan jawaban atas pertanyaan yang sering diajukan dan solusi untuk permasalahan Anda.
    </p>
    <!-- Kolom Pencarian -->
    <div class="flex justify-center">
      <input type="text" name="search" placeholder="Cari bantuan..." class="w-full md:w-1/2 p-4 border border-gray-300 rounded-lg focus:outline-none focus:border-red-500 transition duration-300">
    </div>
  </header>

  <!-- Main Content -->
  <main class="space-y-12">
    <!-- FAQ Section -->
    <section>
      <h2 class="text-3xl font-bold text-gray-800 mb-6">Pertanyaan yang Sering Diajukan</h2>
      <div class="space-y-4">
        <details class="group bg-white rounded-lg p-6 shadow transition duration-300 hover:shadow-lg">
          <summary class="cursor-pointer font-semibold text-xl text-gray-800 flex justify-between items-center">
            Bagaimana cara mendaftar akun?
            <span class="text-red-500 group-open:rotate-180 transition-transform duration-300">
              <i class="fas fa-chevron-down"></i>
            </span>
          </summary>
          <p class="mt-4 text-gray-700">
            Untuk mendaftar akun, klik tombol "Daftar" di halaman login dan isi formulir pendaftaran dengan data yang valid.
            Pastikan untuk menggunakan alamat email yang aktif karena verifikasi akan dikirim ke email tersebut.
          </p>
        </details>
        <details class="group bg-white rounded-lg p-6 shadow transition duration-300 hover:shadow-lg">
          <summary class="cursor-pointer font-semibold text-xl text-gray-800 flex justify-between items-center">
            Bagaimana cara mereset password?
            <span class="text-red-500 group-open:rotate-180 transition-transform duration-300">
              <i class="fas fa-chevron-down"></i>
            </span>
          </summary>
          <p class="mt-4 text-gray-700">
            Jika Anda lupa password, klik "Lupa Password?" di halaman login dan ikuti petunjuk untuk reset password melalui email.
            Pastikan untuk mengecek folder spam jika email tidak muncul.
          </p>
        </details>
        <details class="group bg-white rounded-lg p-6 shadow transition duration-300 hover:shadow-lg">
          <summary class="cursor-pointer font-semibold text-xl text-gray-800 flex justify-between items-center">
            Bagaimana cara mengubah profil saya?
            <span class="text-red-500 group-open:rotate-180 transition-transform duration-300">
              <i class="fas fa-chevron-down"></i>
            </span>
          </summary>
          <p class="mt-4 text-gray-700">
            Untuk mengubah profil, buka menu "Profil" di aplikasi, pilih "Edit Profil" dan lakukan perubahan pada data seperti nama lengkap, username, dan foto profil.
            Jangan lupa untuk menyimpan perubahan Anda.
          </p>
        </details>
        <details class="group bg-white rounded-lg p-6 shadow transition duration-300 hover:shadow-lg">
          <summary class="cursor-pointer font-semibold text-xl text-gray-800 flex justify-between items-center">
            Apa yang harus dilakukan jika aplikasi mengalami error?
            <span class="text-red-500 group-open:rotate-180 transition-transform duration-300">
              <i class="fas fa-chevron-down"></i>
            </span>
          </summary>
          <p class="mt-4 text-gray-700">
            Jika terjadi error, coba restart aplikasi terlebih dahulu. Jika masalah berlanjut, bersihkan cache aplikasi atau update ke versi terbaru.
            Jika masih gagal, hubungi tim dukungan melalui halaman "Hubungi Kami".
          </p>
        </details>
        <details class="group bg-white rounded-lg p-6 shadow transition duration-300 hover:shadow-lg">
          <summary class="cursor-pointer font-semibold text-xl text-gray-800 flex justify-between items-center">
            Bagaimana cara menghubungi tim support?
            <span class="text-red-500 group-open:rotate-180 transition-transform duration-300">
              <i class="fas fa-chevron-down"></i>
            </span>
          </summary>
          <p class="mt-4 text-gray-700">
            Anda dapat menghubungi tim support melalui halaman "Hubungi Kami" atau dengan mengirim email ke support@aplikasi.com.
            Sertakan detail masalah agar kami dapat membantu Anda dengan cepat.
          </p>
        </details>
      </div>
    </section>

    <!-- Topik Bantuan Lainnya Section -->
    <section>
      <h2 class="text-3xl font-bold text-gray-800 mb-6">Topik Bantuan Lainnya</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg transition duration-300">
          <h3 class="text-2xl font-semibold text-gray-800 mb-2">Pengaturan Akun</h3>
          <p class="text-gray-700">
            Pelajari cara mengatur akun Anda, termasuk update profil, pengaturan privasi, dan keamanan akun.
          </p>
          <a href="{{ url('/settings/akun') }}" class="inline-block mt-4 text-red-500 font-semibold hover:underline">
            Baca Selengkapnya &rarr;
          </a>
        </div>
        <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg transition duration-300">
          <h3 class="text-2xl font-semibold text-gray-800 mb-2">Pembayaran & Langganan</h3>
          <p class="text-gray-700">
            Informasi mengenai metode pembayaran, langganan, dan kebijakan refund untuk layanan premium.
          </p>
          <a href="{{ url('/help/pembayaran') }}" class="inline-block mt-4 text-red-500 font-semibold hover:underline">
            Baca Selengkapnya &rarr;
          </a>
        </div>
        <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg transition duration-300">
          <h3 class="text-2xl font-semibold text-gray-800 mb-2">Troubleshooting</h3>
          <p class="text-gray-700">
            Solusi untuk masalah umum yang mungkin Anda hadapi saat menggunakan aplikasi.
          </p>
          <a href="{{ url('/help/troubleshooting') }}" class="inline-block mt-4 text-red-500 font-semibold hover:underline">
            Baca Selengkapnya &rarr;
          </a>
        </div>
        <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg transition duration-300">
          <h3 class="text-2xl font-semibold text-gray-800 mb-2">Panduan Teknis</h3>
          <p class="text-gray-700">
            Tutorial dan dokumentasi lengkap untuk memaksimalkan penggunaan fitur-fitur aplikasi.
          </p>
          <a href="{{ url('/help/teknis') }}" class="inline-block mt-4 text-red-500 font-semibold hover:underline">
            Baca Selengkapnya &rarr;
          </a>
        </div>
      </div>
    </section>

    <!-- Form Kontak Dukungan -->
    <section>
      <h2 class="text-3xl font-bold text-gray-800 mb-6">Butuh Bantuan Lebih Lanjut?</h2>
      <p class="text-gray-700 mb-4">
        Jika pertanyaan Anda belum terjawab, silakan kirim pesan langsung ke tim dukungan kami dengan mengisi formulir di bawah ini.
      </p>
      <form action="{{ url('/hubungi') }}" method="POST" class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        <div class="mb-4">
          <label for="nama" class="block text-gray-800 font-semibold mb-2">Nama Lengkap</label>
          <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap Anda" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-red-500">
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-800 font-semibold mb-2">Email</label>
          <input type="email" name="email" id="email" placeholder="Masukkan alamat email Anda" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-red-500">
        </div>
        <div class="mb-4">
          <label for="pesan" class="block text-gray-800 font-semibold mb-2">Pesan</label>
          <textarea name="pesan" id="pesan" rows="5" placeholder="Tuliskan pertanyaan atau keluhan Anda" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-red-500"></textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
            Kirim Pesan
          </button>
        </div>
      </form>
    </section>
  </main>

  <!-- Footer Bantuan -->
  <footer class="mt-12 text-center">
    <p class="text-gray-600 text-sm">
      &copy; {{ date('Y') }} Aplikasi Anda. All rights reserved. | 
      <a href="{{ url('/privacy-policy') }}" class="text-red-500 hover:underline">Privacy Policy</a> | 
      <a href="{{ url('/terms-of-service') }}" class="text-red-500 hover:underline">Terms of Service</a>
    </p>
  </footer>
</div>
@endsection
