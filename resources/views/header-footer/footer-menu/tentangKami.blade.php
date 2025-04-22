@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-red-600 text-center mb-4">Tentang Kami</h1>

    <!-- Sejarah Organisasi -->
    <section class="mb-6 max-w-2xl mx-auto text-left">
        <h2 class="text-2xl font-semibold text-gray-800">Sejarah UKPM Explant</h2>
        <p class="text-gray-700 leading-relaxed mt-2">
            UKPM Explant (Unit Kegiatan Pers Mahasiswa Explant) berdiri sebagai bentuk pergerakan mahasiswa dalam bidang jurnalistik dan media informasi.
            Organisasi ini lahir dari kebutuhan mahasiswa untuk memiliki ruang ekspresi yang bebas, bertanggung jawab, dan mampu menyuarakan berbagai isu yang berkembang.
        </p>
        <p class="text-gray-700 leading-relaxed mt-2">
            Sejak awal berdirinya, UKPM Explant telah menjadi wadah bagi mahasiswa yang ingin mengembangkan keterampilan menulis, berpikir kritis, dan menyebarkan informasi yang objektif.
            Kami berkomitmen untuk menyajikan berita yang transparan, edukatif, dan berbasis fakta kepada seluruh mahasiswa serta masyarakat luas.
        </p>
    </section>

    <!-- Misi dan Visi -->
    <section class="mb-6 max-w-2xl mx-auto text-left">
        <h2 class="text-2xl font-semibold text-gray-800">Visi dan Misi</h2>
        <p class="text-gray-700 leading-relaxed mt-2">
            **Visi:**
            Menjadi pusat informasi dan media mahasiswa yang kredibel, inovatif, serta menjadi suara bagi kebenaran dan keadilan.
        </p>
        <p class="text-gray-700 leading-relaxed mt-2">
            **Misi:**
        </p>
        <ul class="list-disc pl-5 text-gray-700 leading-relaxed mt-2">
            <li>Menyediakan informasi yang akurat, objektif, dan terpercaya bagi mahasiswa dan masyarakat umum.</li>
            <li>Mengembangkan keterampilan jurnalistik dan media mahasiswa melalui pelatihan dan diskusi.</li>
            <li>Mendorong mahasiswa untuk aktif berkontribusi dalam penyebaran informasi yang berkualitas.</li>
            <li>Membangun jaringan dengan berbagai media dan organisasi jurnalistik untuk memperluas wawasan dan kolaborasi.</li>
        </ul>
    </section>

    <!-- Kegiatan Utama -->
    <section class="mb-6 max-w-2xl mx-auto text-left">
        <h2 class="text-2xl font-semibold text-gray-800">Kegiatan Utama</h2>
        <p class="text-gray-700 leading-relaxed mt-2">
            Sebagai organisasi yang aktif di bidang jurnalistik, UKPM Explant memiliki berbagai kegiatan rutin yang bertujuan untuk meningkatkan kualitas media dan informasi, di antaranya:
        </p>
        <ul class="list-disc pl-5 text-gray-700 leading-relaxed mt-2">
            <li>Pelatihan jurnalistik bagi mahasiswa baru.</li>
            <li>Diskusi dan seminar tentang isu-isu terkini.</li>
            <li>Produksi buletin, majalah, serta media digital lainnya.</li>
            <li>Investigasi dan publikasi berita mengenai berbagai isu kampus dan nasional.</li>
        </ul>
    </section>

</div>
@endsection
