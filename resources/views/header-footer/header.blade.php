<header class="bg-white shadow-md w-full flex items-center justify-between px-6 md:px-12 lg:px-24">
    <div class="container mx-auto flex justify-between items-center px-4 sm:px-6 lg:px-8 py-3">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="text-[#990505] text-xl font-bold">MediaExplant</a>
        </div>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-8">
            <ul class="flex space-x-8">
                @php
                    $currentRoute = Route::currentRouteName();
                @endphp

                <!-- Beranda -->
                <li>
                    <a href="{{ route('home') }}"
                        class="relative px-4 py-2 relative top-[8px] {{ $currentRoute === 'home' ? 'text-[#990505] font-semibold' : 'text-gray-700 hover:text-[#990505]' }}">
                        Beranda
                        @if ($currentRoute === 'home')
                            <span class="absolute left-0 bottom-0 w-full h-[2px] bg-[#990505]"></span>
                        @endif
                    </a>
                </li>

                <!-- Berita -->
                <li class="relative group">
                    <button
                        class="relative px-4 py-2 {{ in_array($currentRoute, ['siaran-pers', 'riset', 'wawancara', 'diskusi', 'agenda', 'opini']) ? 'text-[#990505] font-semibold' : 'text-gray-700 hover:text-[#990505]' }}">
                        Berita
                        <i class="fa-solid fa-chevron-down ml-1 text-sm"></i>
                        @if (in_array($currentRoute, ['siaran-pers', 'riset', 'wawancara', 'diskusi', 'agenda', 'opini']))
                            <span class="absolute left-0 bottom-0 w-full h-[2px] bg-[#990505]"></span>
                        @endif
                    </button>
                    <ul
                        class="absolute left-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <li><a href="{{ route('siaran-pers') }}" class="block px-4 py-2 hover:bg-gray-100">Siaran
                                Pers</a></li>
                        <li><a href="{{ route('riset') }}" class="block px-4 py-2 hover:bg-gray-100">Riset</a></li>
                        <li><a href="{{ route('wawancara') }}" class="block px-4 py-2 hover:bg-gray-100">Wawancara</a>
                        </li>
                        <li><a href="{{ route('diskusi') }}" class="block px-4 py-2 hover:bg-gray-100">Diskusi</a></li>
                        <li><a href="{{ route('agenda') }}" class="block px-4 py-2 hover:bg-gray-100">Agenda</a></li>
                        <li><a href="{{ route('opini') }}" class="block px-4 py-2 hover:bg-gray-100">Opini</a></li>
                    </ul>
                </li>

                <!-- Produk -->
                <li class="relative group">
                    <button
                        class="relative px-4 py-2 {{ in_array($currentRoute, ['buletin', 'majalah']) ? 'text-[#990505] font-semibold' : 'text-gray-700 hover:text-[#990505]' }}">
                        Produk
                        <i class="fa-solid fa-chevron-down ml-1 text-sm"></i>
                        @if (in_array($currentRoute, ['buletin', 'majalah']))
                            <span class="absolute left-0 bottom-0 w-full h-[2px] bg-[#990505]"></span>
                        @endif
                    </button>
                    <ul
                        class="absolute left-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <li><a href="{{ route('buletin') }}" class="block px-4 py-2 hover:bg-gray-100">Buletin</a></li>
                        <li><a href="{{ route('majalah') }}" class="block px-4 py-2 hover:bg-gray-100">Majalah</a></li>
                    </ul>
                </li>

                <!-- Karya -->
                <li class="relative group">
                    <button
                        class="relative px-4 py-2 {{ in_array($currentRoute, ['puisi', 'pantun', 'syair', 'fotografi', 'desain-grafis']) ? 'text-[#990505] font-semibold' : 'text-gray-700 hover:text-[#990505]' }}">
                        Karya
                        <i class="fa-solid fa-chevron-down ml-1 text-sm"></i>
                        @if (in_array($currentRoute, ['puisi', 'pantun', 'syair', 'fotografi', 'desain-grafis']))
                            <span class="absolute left-0 bottom-0 w-full h-[2px] bg-[#990505]"></span>
                        @endif
                    </button>
                    <ul
                        class="absolute left-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <li><a href="{{ route('puisi') }}" class="block px-4 py-2 hover:bg-gray-100">Puisi</a></li>
                        <li><a href="{{ route('pantun') }}" class="block px-4 py-2 hover:bg-gray-100">Pantun</a></li>
                        <li><a href="{{ route('syair') }}" class="block px-4 py-2 hover:bg-gray-100">Syair</a></li>
                        <li><a href="{{ route('fotografi') }}" class="block px-4 py-2 hover:bg-gray-100">Fotografi</a>
                        </li>
                        <li><a href="{{ route('desain-grafis') }}" class="block px-4 py-2 hover:bg-gray-100">Desain
                                Grafis</a></li>
                    </ul>
                </li>

            </ul>
        </nav>

        <!-- Overlay untuk latar belakang gelap -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden transition-opacity duration-300"></div>

        <!-- Sidebar -->
        <div id="searchNotifContainer"
            class="fixed top-0 right-0 w-64 h-screen bg-white shadow-lg transform translate-x-full transition-transform duration-300 p-4">
            <button id="closeSidebar" class="text-gray-500 hover:text-red-700 absolute top-4 right-4">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>

            <div class="flex flex-col space-y-4 mt-10">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#990505] font-semibold">Beranda</a>

                <!-- Media Dropdown -->
                <div class="group">
                    <button class="text-gray-700 hover:text-[#990505] font-semibold w-full text-left">
                        Buat <i class="fa-solid fa-chevron-down ml-1 text-sm text-gray-500"></i>
                    </button>
                    <ul class="hidden group-hover:block mt-2 pl-4 space-y-2">
                        <li><a href="{{ route('create-news') }}" class="text-gray-600 hover:text-[#990505]">Buat
                                Berita</a></li>
                        <li><a href="{{ route('create-product') }}"
                                class="text-gray-600 hover:text-[#990505]">Tambahkan Produk</a></li>
                        <li><a href="{{ route('creation') }}" class="text-gray-600 hover:text-[#990505]">Tambahkan
                                Karya</a></li>
                    </ul>
                </div>

                <!-- Profil Dropdown -->
                <div class="group">
                    <button class="text-gray-700 hover:text-[#990505] font-semibold w-full text-left">
                        Profil <i class="fa-solid fa-chevron-down float-right"></i>
                    </button>
                    <ul class="hidden group-hover:block mt-2 pl-4 space-y-2">
                        <li><a href="{{ route('profile') }}" class="text-gray-600 hover:text-[#990505]">Profil</a></li>
                        <li><a href="{{ route('settings') }}" class="text-gray-600 hover:text-[#990505]">Pengaturan</a>
                        </li>
                        <li><a href="{{ route('logout') }}" class="text-gray-600 hover:text-[#990505]">Keluar</a></li>
                    </ul>
                </div>

                <!-- Notifikasi -->
                <div class="relative">
                    <button class="text-gray-700 hover:text-[#990505] font-semibold w-full text-left">
                        Notifikasi <i class="fa-solid fa-bell float-right"></i>
                    </button>
                    <ul class="hidden mt-2 pl-4 space-y-2">
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Belum ada notifikasi</a></li>
                    </ul>
                </div>

                <!-- Berita Dropdown -->
                <div class="group">
                    <button class="text-gray-700 hover:text-[#990505] font-semibold w-full text-left">
                        Berita <i class="fa-solid fa-chevron-down float-right"></i>
                    </button>
                    <ul class="hidden group-hover:block mt-2 pl-4 space-y-2">
                        <li><a href="{{ route('siaran-pers') }}" class="text-gray-600 hover:text-[#990505]">Siaran
                                Pers</a></li>
                        <li><a href="{{ route('riset') }}" class="text-gray-600 hover:text-[#990505]">Riset</a></li>
                        <li><a href="{{ route('wawancara') }}" class="text-gray-600 hover:text-[#990505]">Wawancara</a>
                        </li>
                        <li><a href="{{ route('diskusi') }}" class="text-gray-600 hover:text-[#990505]">Diskusi</a>
                        </li>
                        <li><a href="{{ route('agenda') }}" class="text-gray-600 hover:text-[#990505]">Agenda</a>
                        </li>
                        <li><a href="{{ route('opini') }}" class="text-gray-600 hover:text-[#990505]">Opini</a></li>
                    </ul>
                </div>

                <!-- Produk Dropdown -->
                <div class="group">
                    <button class="text-gray-700 hover:text-[#990505] font-semibold w-full text-left">
                        Produk <i class="fa-solid fa-chevron-down float-right"></i>
                    </button>
                    <ul class="hidden group-hover:block mt-2 pl-4 space-y-2">
                        <li><a href="{{ route('buletin') }}" class="text-gray-600 hover:text-[#990505]">Buletin</a>
                        </li>
                        <li><a href="{{ route('majalah') }}" class="text-gray-600 hover:text-[#990505]">Majalah</a>
                        </li>
                    </ul>
                </div>

                <!-- Karya Dropdown -->
                <div class="group">
                    <button class="text-gray-700 hover:text-[#990505] font-semibold w-full text-left">
                        Karya <i class="fa-solid fa-chevron-down float-right"></i>
                    </button>
                    <ul class="hidden group-hover:block mt-2 pl-4 space-y-2">
                        <li><a href="{{ route('puisi') }}" class="text-gray-600 hover:text-[#990505]">Puisi</a></li>
                        <li><a href="{{ route('pantun') }}" class="text-gray-600 hover:text-[#990505]">Pantun</a>
                        </li>
                        <li><a href="{{ route('syair') }}" class="text-gray-600 hover:text-[#990505]">Syair</a></li>
                        <li><a href="{{ route('fotografi') }}"
                                class="text-gray-600 hover:text-[#990505]">Fotografi</a></li>
                        <li><a href="{{ route('desain-grafis') }}" class="text-gray-600 hover:text-[#990505]">Desain
                                Grafis</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Toggle Button for Sidebar -->
        <button id="toggleSearchNotif" class="md:hidden text-gray-500 hover:text-red-700">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

        <!-- Search & Notifications -->
        <div id="searchNotifContainer"
            class="fixed top-0 right-0 w-48 h-screen bg-white shadow-lg transform translate-x-full transition-transform duration-300 flex flex-col items-center justify-center space-y-4 md:flex-row md:relative md:w-auto md:h-auto md:bg-transparent md:translate-x-0 md:shadow-none md:space-x-4 md:space-y-0 hidden md:flex">
            <button class="text-gray-500 hover:text-red-700">
                <i class="fa-solid fa-magnifying-glass text-lg"></i>
            </button>
            <button class="text-gray-500 hover:text-red-700">
                <i class="fa-solid fa-bell text-lg"></i>
            </button>

            <!-- Media Dropdown -->
            <div class="relative">
                <button id="articleButton"
                    class="flex items-center space-x-2 text-gray-700 hover:text-red-700 focus:outline-none">
                    <i class="fa-solid fa-square-plus text-lg text-gray-500 hover:text-red-700 focus:outline-none"></i>
                    <span class="text-sm">Buat</span>
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M7 10l5 5 5-5H7z" />
                    </svg>
                </button>
                <div id="articleDropdown"
                    class="absolute right-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded-md hidden">
                    <a href="{{ route('create-news') }}" class="block px-4 py-2 hover:bg-gray-100">Buat Berita</a>
                    <a href="{{ route('create-product') }}" class="block px-4 py-2 hover:bg-gray-100">Tambahkan
                        Produk</a>
                    <a href="{{ route('creation') }}" class="block px-4 py-2 hover:bg-gray-100">Tambahkan Karya</a>
                </div>
            </div>

            <!-- Profil Dropdown -->
            <div class="relative">
                @php
                    $userUid = Cookie::get('user_uid');
                    $user = $userUid ? \App\Models\User::where('uid', $userUid)->first() : null;
                @endphp
                <button id="profileButton"
                    class="flex items-center space-x-2 text-gray-700 hover:text-red-700 focus:outline-none">
                    @if ($user && $user->profile_pic)
                        <img src="{{ asset($user->profile_pic) }}" alt="Profil" class="w-8 h-8 rounded-full">
                    @else
                        <i class="fa-solid fa-user-circle text-lg"></i>
                    @endif
                    @if ($user)
                        <span class="text-sm">{{ $user->nama_pengguna }}</span>
                    @endif
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M7 10l5 5 5-5H7z" />
                    </svg>
                </button>
                <div id="profileDropdown"
                    class="absolute right-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded-md hidden">
                    @if ($user)
                        <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                        <a href="{{ route('settings') }}" class="block px-4 py-2 hover:bg-gray-100">Pengaturan</a>
                        <a href="{{ route('draft-media') }}" class="block px-4 py-2 hover:bg-gray-100">Draf</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil elemen dropdown media dan profil
        const articleButton = document.getElementById("articleButton");
        const articleDropdown = document.getElementById("articleDropdown");

        const profileButton = document.getElementById("profileButton");
        const profileDropdown = document.getElementById("profileDropdown");

        // Fungsi untuk menutup semua dropdown
        function closeAllDropdowns() {
            articleDropdown.classList.add("hidden");
            profileDropdown.classList.add("hidden");
        }

        articleButton.addEventListener("click", (e) => {
            e.stopPropagation();
            closeAllDropdowns(); // Tutup dropdown lain
            articleDropdown.classList.toggle("hidden");
        });

        profileButton.addEventListener("click", (e) => {
            e.stopPropagation();
            closeAllDropdowns(); // Tutup dropdown lain
            profileDropdown.classList.toggle("hidden");
        });

        // Tutup dropdown ketika klik di luar
        document.addEventListener("click", closeAllDropdowns);

        // Sidebar Toggle
        const toggleButton = document.getElementById("toggleSearchNotif");
        const closeButton = document.getElementById("closeSidebar");
        const searchNotifContainer = document.getElementById("searchNotifContainer");
        const overlay = document.getElementById("overlay");

        function openSidebar() {
            searchNotifContainer.classList.remove("translate-x-full", "hidden");
            searchNotifContainer.classList.add("translate-x-0");
            overlay.classList.remove("hidden");
            overlay.classList.add("opacity-100");
        }

        function closeSidebar() {
            searchNotifContainer.classList.add("translate-x-full");
            searchNotifContainer.classList.remove("translate-x-0");
            overlay.classList.add("hidden");
            overlay.classList.remove("opacity-100");
        }

        toggleButton.addEventListener("click", openSidebar);
        closeButton.addEventListener("click", closeSidebar);
        overlay.addEventListener("click", closeSidebar);
    });
</script>

<!-- FontAwesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
