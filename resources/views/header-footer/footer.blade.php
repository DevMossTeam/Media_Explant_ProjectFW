<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <!-- Menambahkan Font Awesome untuk ikon sosial media -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Menambahkan Tailwind CSS untuk styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <footer class="bg-black text-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Kolom Tentang Kita -->
            <div class="flex justify-center">
                <div class="text-left">
                    <h3 class="text-red-600 text-lg font-bold mb-4">TENTANG KITA</h3>
                    <p class="text-sm leading-relaxed">
                        Persmahasiswa.id lahir atas kebutuhan seluruh awak pers mahasiswa yang terbatas jarak, waktu, dan tempat untuk bertemu dan saling berinteraksi. Ruang Pengawalan Isu, Ruang Diskusi, Sindikasi Berita Pers Mahasiswa, dan Pusat Sirkulasi Data PPMI diharapkan bisa jadi benang merah untuk mengatasi segala keterbatasan itu.
                    </p>
                    <p class="text-sm mt-4">
                        Hubungi kami: 
                        <a href="mailto:ppminasional1992@gmail.com" class="text-red-500">ppminasional1992@gmail.com</a>
                    </p>
                </div>
            </div>

            <!-- Kolom Ikuti Kami -->
            <div>
                <h3 class="text-red-600 text-lg font-bold mb-4">IKUTI KAMI</h3>
                <div class="flex space-x-4">
                    <!-- Facebook -->
                    <a href="#" class="text-red-600 hover:text-red-800 text-2xl">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <!-- Instagram -->
                    <a href="#" class="text-red-600 hover:text-red-800 text-2xl">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <!-- YouTube -->
                    <a href="#" class="text-red-600 hover:text-red-800 text-2xl">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center text-sm mt-8 px-4 sm:px-6 lg:px-8">
            &copy; Oleh solidaritas Pers Mahasiswa
        </div>
    </footer>
</body>
</html>
