@extends('layouts.app')

@section('content')
<main class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Artikel Detail -->
            <div class="lg:col-span-2">
                <!-- Cover Image dan Judul -->
                <div class="relative">
                    <img class="w-full h-96 object-cover" src="https://via.placeholder.com/1200x500" alt="Cover image">
                    <div class="absolute top-4 left-4 bg-black bg-opacity-50 text-white py-2 px-4 rounded-lg">
                        <h1 class="text-4xl font-bold">Detail Artikel {{ $id }}</h1>
                    </div>
                </div>

                <!-- Informasi Artikel -->
                <div class="mt-6">
                    <div class="text-gray-600 text-sm mb-4">
                        <span>Penulis: <strong>John Doe</strong></span> |
                        <span>Dipublikasikan: <strong>January 3, 2025</strong></span>
                    </div>

                    <!-- Isi Artikel -->
                    <p class="text-gray-700 text-lg mb-4">
                        Dunia teknologi telah mengalami transformasi besar-besaran selama beberapa dekade terakhir. Dari telepon pintar hingga kecerdasan buatan, 
                        inovasi teknologi telah mengubah cara kita hidup, bekerja, dan berkomunikasi. Artikel ini mengeksplorasi perubahan tersebut, dengan fokus pada 
                        dampaknya terhadap masyarakat modern.
                    </p>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">1. Pengenalan</h2>
                    <p class="text-gray-700 text-lg mb-4">
                        Teknologi bukan hanya alat, melainkan elemen penting dalam kehidupan sehari-hari. Dengan semakin berkembangnya teknologi seperti cloud computing 
                        dan blockchain, masyarakat dapat menikmati efisiensi dan aksesibilitas yang lebih baik di berbagai sektor, termasuk pendidikan, kesehatan, dan bisnis.
                    </p>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">2. Dampak Teknologi terhadap Kehidupan</h2>
                    <p class="text-gray-700 text-lg mb-4">
                        Dalam sektor pendidikan, teknologi telah memungkinkan pembelajaran jarak jauh melalui platform seperti Zoom dan Google Classroom. 
                        Sementara itu, di dunia bisnis, adopsi teknologi telah menciptakan efisiensi melalui otomatisasi dan analitik data yang lebih baik.
                    </p>
                    <p class="text-gray-700 text-lg mb-4">
                        Tidak hanya itu, media sosial telah menjadi alat penting dalam penyebaran informasi, meskipun menghadirkan tantangan seperti penyebaran berita palsu dan 
                        ancaman privasi.
                    </p>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">3. Tantangan dan Peluang</h2>
                    <p class="text-gray-700 text-lg mb-4">
                        Teknologi tidak hanya membawa peluang, tetapi juga tantangan besar. Misalnya, masalah keamanan data dan privasi menjadi perhatian utama di era digital ini. 
                        Namun, dengan pendekatan yang tepat, tantangan tersebut dapat diatasi dan peluang baru dapat tercipta.
                    </p>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">4. Kesimpulan</h2>
                    <p class="text-gray-700 text-lg mb-4">
                        Teknologi adalah pedang bermata dua. Meskipun menghadirkan tantangan, teknologi juga menawarkan peluang besar untuk meningkatkan kualitas hidup. 
                        Adaptasi dan pembelajaran adalah kunci untuk memanfaatkan teknologi secara maksimal.
                    </p>

                    <!-- Tombol Aksi -->
                    <div class="mt-6">
                        <div class="flex flex-wrap items-center gap-4">
                            <button class="flex items-center gap-2 text-gray-700 hover:text-green-500 transition px-4 py-2 border border-gray-300 rounded-lg">
                                <i class="fas fa-thumbs-up"></i>
                                <span>Like</span>
                            </button>
                            <button class="flex items-center gap-2 text-gray-700 hover:text-red-500 transition px-4 py-2 border border-gray-300 rounded-lg">
                                <i class="fas fa-thumbs-down"></i>
                                <span>Dislike</span>
                            </button>
                            <button class="flex items-center gap-2 text-gray-700 hover:text-blue-500 transition px-4 py-2 border border-gray-300 rounded-lg">
                                <i class="fas fa-share-alt"></i>
                                <span>Share</span>
                            </button>
                            <button class="flex items-center gap-2 text-gray-700 hover:text-yellow-500 transition px-4 py-2 border border-gray-300 rounded-lg">
                                <i class="fas fa-bookmark"></i>
                                <span>Bookmark</span>
                            </button>
                            <button class="flex items-center gap-2 text-gray-700 hover:text-orange-500 transition px-4 py-2 border border-gray-300 rounded-lg">
                                <i class="fas fa-flag"></i>
                                <span>Report</span>
                            </button>
                        </div>
                    </div>

                    <!-- Bagian Komentar -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Komentar (0)</h2>
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50" style="height: 400px;">
                            <!-- Form Komentar -->
                            <div class="flex items-center gap-4 mb-4">
                                <input 
                                    type="text" 
                                    placeholder="Tulis komentarmu di sini" 
                                    class="flex-grow border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>

                            <!-- Tidak Ada Komentar -->
                            <div class="flex items-center justify-center text-center text-gray-500 h-full">
                                <i class="fas fa-comment-dots text-2xl mb-2"></i>
                                <p>Belum ada komentar. Jadilah yang pertama untuk memberikan komentar!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Daftar Berita -->
            <div class="lg:col-span-1">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Daftar Berita</h2>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Filter</button>
                </div>
                <div class="space-y-4">
                    @for ($i = 1; $i <= 5; $i++) <!-- Limit to 5 news items -->
                    <div class="flex items-start gap-4">
                        <img src="https://via.placeholder.com/100x100" alt="Thumbnail {{ $i }}" class="w-20 h-20 object-cover rounded-lg">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Judul Berita {{ $i }}</h3>
                            <p class="text-sm text-gray-600">Deskripsi singkat berita nomor {{ $i }} yang memberikan informasi penting.</p>
                        </div>
                    </div>
                    @endfor
                </div>

                <!-- Label -->
                <div class="flex flex-wrap items-center gap-2 mt-6">
                    @foreach ([
                        '#Teknologi', '#Inovasi', '#AI', '#Blockchain', '#Digitalisasi', 
                        '#Startup', '#Keamanan', '#Edukasi', '#Kesehatan', '#Pendidikan', 
                        '#Internet', '#Cybersecurity', '#CloudComputing', '#DataScience', '#MachineLearning',
                        '#BigData', '#FinTech', '#HealthTech', '#SmartCity', '#IoT', 
                        '#Automation', '#TechTrends', '#ArtificialIntelligence', '#DeepLearning', '#Robotics',
                        '#QuantumComputing', '#VirtualReality', '#AugmentedReality', '#5G', '#Wearables',
                        '#TechNews', '#Gadget', '#MobileTech', '#SmartHome', '#SocialMedia', '#VideoGames'
                    ] as $label)
                    <span class="bg-red-600 text-white text-sm font-medium px-2 py-1 rounded">{{ $label }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
