<header class="bg-red-600 text-white p-4">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">Persma.id</h1>
            <p class="text-sm">Rawat ingatan, diskusi, dan menulis</p>
        </div>
        <!-- Artikel Dropdown -->
        <div class="relative ml-auto mr-4">
            <button id="articleButton" class="flex items-center space-x-2 focus:outline-none">
                <i class="fa-solid fa-file-alt text-2xl"></i>
                <span class="text-sm">Artikel</span>
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
                    <path d="M7 10l5 5 5-5H7z" />
                </svg>
            </button>
            <div id="articleDropdown" class="absolute right-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded-md hidden">
                <a href="{{ route('create-article') }}" class="block px-4 py-2 hover:bg-gray-100">Buat Artikel</a>
                <a href="{{ route('draft-article') }}" class="block px-4 py-2 hover:bg-gray-100">Draf</a>
            </div>
        </div>
        <!-- Profil Dropdown -->
        <div class="relative ml-4">
            @php
                $userUid = Cookie::get('user_uid');
                $user = $userUid ? \App\Models\User::where('uid', $userUid)->first() : null;
            @endphp
            <button id="profileButton" class="flex items-center space-x-2 focus:outline-none">
                @if($user && $user->profile_pic)
                    <img src="{{ asset($user->profile_pic) }}" alt="Profil" class="w-8 h-8 rounded-full">
                @else
                    <i class="fa-solid fa-user-circle text-2xl"></i>
                @endif
                @if($user)
                    <span class="text-sm">{{ $user->nama_pengguna }}</span>
                @endif
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
                    <path d="M7 10l5 5 5-5H7z" />
                </svg>
            </button>
            <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded-md hidden">
                @if($user)
                    <a href="{{ route('settings') }}" class="block px-4 py-2 hover:bg-gray-100">Pengaturan</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">Login</a>
                @endif
            </div>
        </div>
    </div>
</header>

<nav class="bg-gray-800 text-white">
    <div class="container mx-auto flex justify-between items-center px-4 sm:px-6 lg:px-8 py-2">
        <ul class="flex space-x-4">
            <li><a href="{{ route('home') }}" class="hover:text-red-500">Beranda</a></li>
            <li><a href="{{ route('siaran-pers') }}" class="hover:text-red-500">Siaran Pers</a></li>
            <li><a href="{{ route('riset') }}" class="hover:text-red-500">Riset</a></li>
            <li><a href="{{ route('wawancara') }}" class="hover:text-red-500">Wawancara</a></li>
            <li><a href="{{ route('diskusi') }}" class="hover:text-red-500">Diskusi</a></li>
            <li><a href="{{ route('agenda') }}" class="hover:text-red-500">Agenda</a></li>
        </ul>
    </div>
</nav>

<script>
    // Toggle untuk dropdown artikel
    const articleButton = document.getElementById('articleButton');
    const articleDropdown = document.getElementById('articleDropdown');

    articleButton.addEventListener('click', () => {
        articleDropdown.classList.toggle('hidden');
    });

    // Toggle untuk dropdown profil
    const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');

    profileButton.addEventListener('click', () => {
        profileDropdown.classList.toggle('hidden');
    });

    // Tutup dropdown ketika klik di luar
    document.addEventListener('click', (e) => {
        if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
            profileDropdown.classList.add('hidden');
        }
        if (!articleButton.contains(e.target) && !articleDropdown.contains(e.target)) {
            articleDropdown.classList.add('hidden');
        }
    });
</script>

<!-- Tambahkan FontAwesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
