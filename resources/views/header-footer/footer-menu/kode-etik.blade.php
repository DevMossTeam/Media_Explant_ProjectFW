@extends('layouts.app')

@section('content')
<!-- Header Merah Full Width -->
<div class="bg-[#C12122] text-white text-center py-3 w-full">
    <h1 class="text-2xl font-semibold">Kode Etik Perhimpunan Pers Mahasiswa Indonesia (PPMI)</h1>
</div>

<!-- Konten dengan padding atas bawah -->
<div class="py-12 px-4 sm:px-6 lg:px-8">
    <section class="mb-6 max-w-2xl mx-auto text-justify">
        <h2 class="italic text-gray-800 mb-2">Penjelasan Singkat</h2>
        <p class="border-b border-gray-400 mb-4"></p>

        <div class="text-center">
            <img src="{{ asset('assets/LOGO-PPMI-250.png') }}" alt="Logo PPMI" class="mx-auto mb-6">
        </div>

        <p class="text-gray-700 leading-relaxed mt-2">
            @php
            $cleanHtml = $kodeEtikDeskripsi;

            // Hapus class ql-indent-1 supaya bullet dan numbering muncul normal
            $cleanHtml = str_replace('class="ql-indent-1"', '', $cleanHtml);

            // Hapus h2 kosong
            $cleanHtml = preg_replace('/<h2>\s*<br\s*\/?>\s* <\/h2>/', '' , $cleanHtml); @endphp <div
                    class="space-y-6 text-gray-800">
                    {!! $cleanHtml !!}
</div>

<style>
    /* styling list supaya indent dan numbering/bullet jelas */
    ol {
        list-style-type: decimal;
        margin-left: 1.5rem;
        /* indent */
        padding-left: 0;
    }

    ul {
        list-style-type: disc;
        margin-left: 1.5rem;
        /* indent */
        padding-left: 0;
    }

    ol li,
    ul li {
        margin-top: 0.25rem;
        margin-bottom: 0.25rem;
    }

    h2 {
        font-weight: 700;
        font-size: 1.5rem;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        color: #1a202c;
        /* Tailwind gray-900 */
    }

    p {
        margin-bottom: 1rem;
        line-height: 1.6;
    }

</style>
{{-- Perhimpunan Pers Mahasiswa Indonesia (PPMI) adalah organisasi nasional yang menghimpun lembaga-lembaga pers
                mahasiswa dari seluruh Indonesia. Sebagai wadah perjuangan dan pengorganisiran pers mahasiswa, PPMI memiliki
                kode etik yang menjadi pedoman moral dan profesional dalam menjalankan kerja-kerja jurnalistik. --}}
</p>

{{-- <p class="text-gray-700 leading-relaxed mt-2">
    Kode Etik ini berfungsi untuk menjaga integritas, independensi, serta tanggung jawab sosial pers mahasiswa dalam
    menyuarakan kebenaran, membela hak rakyat, dan mencerdaskan kehidupan bangsa. Seluruh anggota PPMI wajib
    menjunjung tinggi isi dari kode etik ini dalam setiap aktivitas kepenulisan, peliputan, dan penerbitan karya
    jurnalistik.
</p> --}}
</section>

{{-- <section class="max-w-2xl mx-auto text-justify mt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Kode Etik</h2>
            <ol class="list-decimal pl-6 text-gray-700 space-y-4">
                <li>Pers mahasiswa mengutamakan idealisme.</li>
                <li>Mengutamakan netralitas, independensi, dan etika jurnalistik.</li>
                <li>Menjunjung tinggi Hak Asasi Manusia.</li>
                <li>Proaktif dalam usaha mencerdaskan bangsa.</li>
                <li>Dengan penuh tanggung jawab menghormati, memenuhi, dan menjunjung tinggi hak rakyat untuk memperoleh
                    informasi yang benar dan jelas.</li>
                <li>Menghindari pemberitaan diskriminasi yang berbau SARA.</li>
                <li>Wajib menghargai dan melindungi hak narasumber yang tidak mau disebut nama dan identitasnya.</li>
                <li>Menghargai 'off the record' terhadap korban kesusilaan dan/atau pelaku kejahatan/tindak pidana di bawah
                    umur.</li>
                <li>Dengan jelas dan jujur menyebut sumber ketika menggunakan berita atau tulisan dari suatu penerbitan, repro
                    gambar/ilustrasi, foto, dan/atau karya orang lain.</li>
                <li>Senantiasa mempertahankan prinsip-prinsip kebebasan dan harus objektif serta profesional dalam pemberitaan,
                    menghindari penafsiran dan kesimpulan yang menyesatkan.</li>
                <li>Tidak boleh menerima segala macam bentuk suap, menyiarkan atau mempublikasikan informasi, serta tidak
                    memanfaatkan posisi dan informasi yang dimilikinya untuk kepentingan pribadi dan golongan.</li>
                <li>Wajib memperhatikan dan menindaklanjuti proses, hak jawab, somasi, gugatan, dan/atau keberatan-keberatan
                    lain dari informasi yang dipublikasikan berupa pernyataan tertulis atau ralat.</li>
            </ol>
        </section> --}}
</div>
@endsection
