@extends('layouts.app')

@section('content')
    <!-- Header Merah Full Width -->
    <div class="bg-[#C12122] text-white text-center py-3 w-full">
        <h1 class="text-2xl font-semibold">Explant Contributor</h1>
    </div>

    <!-- Konten dengan padding -->
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <section class="mb-6 max-w-2xl mx-auto text-justify">
            <h2 class="italic text-gray-800 mb-2">Penjelasan Singkat</h2>
            <p class="border-b border-gray-400 mb-4"></p>
            @php
            $cleanHtml = $explantContributorDeskripsi;
        
            // Hapus class ql-indent-1 supaya bullet dan numbering muncul normal
            $cleanHtml = str_replace('class="ql-indent-1"', '', $cleanHtml);
        
            // Hapus h2 kosong
            $cleanHtml = preg_replace('/<h2>\s*<br\s*\/?>\s*<\/h2>/', '', $cleanHtml);
        @endphp
        
        <div class="space-y-6 text-gray-800">
            {!! $cleanHtml ?? '' !!}
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
        
        </section>
{{-- 
        <section class="mb-6 max-w-2xl mx-auto text-justify">
            <h2 class="italic text-gray-800 mb-2">Siapa Saja Mereka?</h2>
            <p class="border-b border-gray-400 mb-4"></p>
            <p class="text-gray-700 leading-relaxed mt-2">Explant Contributor terdiri dari:</p>
            <ol class="list-decimal pl-6 text-gray-700 space-y-2 mt-2">
                <li><b>Penulis</b><br>Mahasiswa yang menulis berita, opini, puisi, pantun, atau esai mendalam. Mereka memadukan
                    observasi lapangan dan refleksi pemikiran untuk menghasilkan karya yang bermakna.</li>
                <li><b>Fotografer</b><br>Kontributor yang menangkap realitas melalui lensa. Mereka menghadirkan perspektif
                    visual dari isu sosial, kehidupan kampus, hingga momen-momen yang sering luput dari perhatian.</li>
                <li><b>Desainer Grafis</b><br>Mereka merancang visualisasi pesan, membuat poster kritik, infografis, hingga
                    ilustrasi untuk memperkuat narasi yang dibangun oleh redaksi.</li>
                <li><b>Editor & Kurator</b><br>Kontributor yang bertugas menyunting, memilih, dan menyusun karya yang masuk agar
                    tetap sejalan dengan visi MediaExplant. Mereka memastikan setiap konten layak tayang dari segi kualitas dan
                    etika.</li>
                <li><b>Distributor & Social Media Handler</b><br>Mereka membantu menyebarluaskan konten MediaExplant melalui
                    kanal media sosial, menjaga interaksi dengan pembaca, serta memastikan karya sampai ke publik yang lebih
                    luas.</li>
            </ol>
        </section>

        <section class="mb-6 max-w-2xl mx-auto text-justify">
            <h2 class="italic text-gray-800 mb-2">Bergabung Jadi Explant Contributor</h2>
            <p class="border-b border-gray-400 mb-4"></p>
            <p class="text-gray-700 leading-relaxed mt-2">
                Kami membuka ruang kolaborasi bagi mahasiswa yang ingin ikut menulis, memotret, mendesain, atau bahkan sekadar
                berbagi ide. Tak perlu jadi “ahli” yang kami cari adalah keberanian untuk berbicara dan semangat untuk belajar
                bersama.
            </p>

            <div class="mt-4 space-y-2">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-[#000000] mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M21 8V7l-3 2-2-2-2 2-2-2-2 2-2-2-3 2V8l3-2 2 2 2-2 2 2 2-2 2 2 3-2zM3 20V10h18v10H3zm2-8v6h14v-6H5z" />
                    </svg>
                    <span class="text-gray-700">Kirim pertanyaanmu ke : <b>ukpmexplant@journalist.com</b></span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-[#000000] mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7.75 2A5.75 5.75 0 0 0 2 7.75v8.5A5.75 5.75 0 0 0 7.75 22h8.5A5.75 5.75 0 0 0 22 16.25v-8.5A5.75 5.75 0 0 0 16.25 2h-8.5Zm0 1.5h8.5A4.25 4.25 0 0 1 20.5 7.75v8.5A4.25 4.25 0 0 1 16.25 20.5h-8.5A4.25 4.25 0 0 1 3.5 16.25v-8.5A4.25 4.25 0 0 1 7.75 3.5Zm7.62 2.08a.75.75 0 1 0-1.44.34.75.75 0 0 0 1.44-.34ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 1.5A3.5 3.5 0 1 1 8.5 12 3.5 3.5 0 0 1 12 8.5Z" />
                    </svg>
                    <span class="text-gray-700">Atau DM kami di Instagram : <b>@ukpmexplant</b></span>
                </div>
            </div>
        </section> --}}
    </div>
@endsection
