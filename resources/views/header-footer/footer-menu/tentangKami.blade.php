@extends('layouts.app')

@section('content')

<!-- Header Merah Full Width -->
<div class="bg-[#C12122] text-white text-center py-3 w-full">
    <h1 class="text-2xl font-semibold">Tentang Media Explant</h1>
</div>

<!-- Penjelasan Singkat -->
<section class="my-8 max-w-4xl mx-auto px-4">
    <h2 class="italic font-semibold text-lg">Penjelasan Singkat</h2>
    <hr class="border-t border-gray-400 my-2">

    <!-- Logo -->
    <div class="flex justify-center my-4">
        <img src="{{ asset('assets/UKPM-EXPLANT-ORIGIN1-IC.svg') }}" alt="Logo Explant" class="w-64">
    </div>

    @php
        $cleanHtml = $tentangKamiDeskripsi;

        // Hapus class ql-indent-1 supaya bullet dan numbering muncul normal
        $cleanHtml = str_replace('class="ql-indent-1"', '', $cleanHtml);

        // Hapus h2 kosong
        $cleanHtml = preg_replace('/<h2>\s*<br\s*\/?>\s*<\/h2>/', '', $cleanHtml);
    @endphp

    <div class="text-gray-700 leading-relaxed mt-2">
        {!! $cleanHtml !!}
    </div>

    <style>
        /* styling list supaya indent dan numbering/bullet jelas */
        ol {
            list-style-type: decimal;
            margin-left: 1.5rem; /* indent */
            padding-left: 0;
        }
        ul {
            list-style-type: disc;
            margin-left: 1.5rem; /* indent */
            padding-left: 0;
        }
        ol li, ul li {
            margin-top: 0.25rem;
            margin-bottom: 0.25rem;
        }
        h2 {
            font-weight: 700;
            font-size: 1.5rem;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: #1a202c; /* Tailwind gray-900 */
        }
        p {
            margin-bottom: 1rem;
            line-height: 1.6;
        }
    </style>

    {{-- <p class="text-gray-800 leading-relaxed mb-4">
        MediaExplant adalah sebuah platform pers mahasiswa yang berdiri atas dasar semangat independensi, kebebasan berekspresi, dan keberpihakan pada kebenaran. Kami bukan sekadar media, tapi sebuah ruang alternatif yang memperjuangkan ekspresi, pemikiran kritis, dan kebebasan informasi di tengah arus informasi yang semakin cepat dan sering kali dangkal.
    </p>
    <p class="text-gray-800 leading-relaxed mb-4">
        Berangkat dari keresahan terhadap realitas sosial yang kerap terpinggirkan, MediaExplant berkomitmen untuk menghidupkan kembali semangat jurnalistik mahasiswa yang berpihak pada publik, bersikap kritis terhadap kekuasaan, serta tidak takut untuk menyuarakan apa yang perlu disuarakan, meski itu tidak populer.
    </p>
    <p class="text-gray-800 leading-relaxed mb-4">
        Kami percaya bahwa mahasiswa bukan hanya objek dari sistem pendidikan, tetapi juga subjek aktif dalam membangun kesadaran kolektif melalui tulisan, visual, dan karya sastra. MediaExplant adalah rumah bagi siapa saja yang ingin menjadikan karya sebagai bentuk perlawanan, ekspresi sebagai bentuk eksistensi, dan jurnalistik sebagai alat untuk menjelaskan kenyataan.
    </p> --}}
{{-- </section> --}}




<!-- Fokus Utama -->
{{-- <section class="my-8 max-w-4xl mx-auto px-4">
    <h2 class="italic font-semibold text-lg">Fokus Utama MediaExplant</h2>
    <hr class="border-t border-gray-400 my-2">

    <p class="text-gray-800 leading-relaxed mb-2">
        MediaExplant hadir dalam tiga kanal utama:
    </p>

    <ol class="list-decimal pl-5 text-gray-800 leading-relaxed space-y-2">
        <li>
            <span class="font-semibold">Berita</span><br>
            Menyajikan liputan aktual seputar isu sosial, pendidikan, kampus, hingga pergerakan masyarakat. Dengan 10 topik pilihan:
            <ul class="list-disc pl-5 mt-1">
                <li>Berita</li>
                <li>Buletin</li>
                <li>Majalah</li>
                <li>Puisi</li>
                <li>Pantun</li>
                <li>Syair</li>
                <li>Fotografi</li>
                <li>Desain Grafis</li>
            </ul>
        </li>

        <li>
            <span class="font-semibold">Produk</span><br>
            Merupakan ruang distribusi karya jurnalistik cetak dan digital, terdiri atas:
            <ul class="list-disc pl-5 mt-1">
                <li>Buletin</li>
                <li>Majalah</li>
            </ul>
        </li>

        <li>
            <span class="font-semibold">Karya</span><br>
            Menjadi panggung ekspresi sastra dan visual, terdiri atas:
            <ul class="list-disc pl-5 mt-1">
                <li>Puisi</li>
                <li>Pantun</li>
                <li>Syair</li>
                <li>Fotografi</li>
                <li>Desain Grafis</li>
            </ul>
        </li>
    </ol> --}}
</section>

@endsection
