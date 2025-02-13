@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-red-600 text-center mb-4">Kode Etik UKPM Explant</h1>

    <!-- Prinsip Dasar -->
    <section class="mb-6 max-w-2xl mx-auto text-left">
        <h2 class="text-2xl font-semibold text-gray-800">Prinsip Dasar Jurnalistik</h2>
        <p class="text-gray-700 leading-relaxed mt-2">
            Sebagai organisasi pers mahasiswa, UKPM Explant memegang teguh prinsip dasar jurnalistik yang berorientasi pada kebenaran, independensi, dan keadilan.
            Prinsip ini menjadi pedoman dalam setiap produksi berita dan penyajian informasi.
        </p>
        <p class="text-gray-700 leading-relaxed mt-2">
            Kami percaya bahwa pers mahasiswa memiliki peran penting dalam mengawal demokrasi kampus dan memberikan ruang bagi suara mahasiswa yang kritis serta independen.
        </p>
    </section>

    <!-- Etika Jurnalistik -->
    <section class="mb-6 max-w-2xl mx-auto text-left">
        <h2 class="text-2xl font-semibold text-gray-800">Etika Jurnalistik UKPM Explant</h2>
        <ul class="list-disc pl-5 text-gray-700 leading-relaxed mt-2">
            <li>Menulis dan menyajikan berita secara jujur, akurat, dan berimbang.</li>
            <li>Tidak menyebarkan hoaks, fitnah, atau informasi yang tidak bisa dipertanggungjawabkan.</li>
            <li>Menghormati hak narasumber dengan melakukan wawancara secara etis.</li>
            <li>Tidak menerima atau memberikan imbalan dalam bentuk apapun yang dapat mempengaruhi independensi berita.</li>
            <li>Menjaga profesionalisme dalam menyajikan konten dan tidak melakukan plagiarisme.</li>
        </ul>
    </section>

    <!-- Sanksi Pelanggaran -->
    <section class="mb-6 max-w-2xl mx-auto text-left">
        <h2 class="text-2xl font-semibold text-gray-800">Sanksi bagi Pelanggaran Kode Etik</h2>
        <p class="text-gray-700 leading-relaxed mt-2">
            Untuk menjaga integritas UKPM Explant, setiap anggota yang melanggar kode etik akan dikenakan sanksi berdasarkan tingkat pelanggaran yang dilakukan, di antaranya:
        </p>
        <ol class="list-decimal pl-5 text-gray-700 leading-relaxed mt-2">
            <li>Peringatan secara lisan atau tertulis.</li>
            <li>Pemanggilan oleh dewan redaksi untuk klarifikasi.</li>
            <li>Pembekuan keanggotaan dalam jangka waktu tertentu.</li>
            <li>Pemberhentian dari UKPM Explant jika terjadi pelanggaran berat.</li>
        </ol>
    </section>

    <!-- Komitmen UKPM Explant -->
    <section class="mb-6 max-w-2xl mx-auto text-left">
        <h2 class="text-2xl font-semibold text-gray-800">Komitmen Kami</h2>
        <p class="text-gray-700 leading-relaxed mt-2">
            UKPM Explant berkomitmen untuk terus mengedepankan prinsip jurnalistik yang jujur, adil, dan transparan. Kami percaya bahwa kebebasan pers harus disertai dengan tanggung jawab moral dan profesionalisme dalam setiap karya yang kami hasilkan.
        </p>
    </section>
</div>
@endsection
