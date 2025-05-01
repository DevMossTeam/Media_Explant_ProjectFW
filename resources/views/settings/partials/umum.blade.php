<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-yadaYadaHashKey" crossorigin="anonymous" referrerpolicy="no-referrer" />
<h2 class="text-red-600 font-bold mb-6 text-lg">Profile Akun Anda</h2>

<!-- Foto Profil -->
<div class="flex items-center mb-6">
    <div class="relative w-24 h-24 flex-shrink-0">
        @if ($user->profile_pic)
            <img src="{{ asset($user->profile_pic) }}" class="w-24 h-24 object-cover rounded-full border-4 border-red-500"
                alt="Profile Picture">
        @else
            <div class="w-24 h-24 rounded-full border-4 border-red-500 bg-[#2c3440] flex items-center justify-center">
                <i class="fa-solid fa-user text-white text-6xl"></i>
            </div>
        @endif

        <!-- Icon Kamera -->
        <div
            class="absolute -bottom-0 right-0 transform translate-x-1/4 w-10 h-10 bg-red-500 rounded-full border-4 border-white flex items-center justify-center">
            <i class="fas fa-camera text-white text-sm"></i>
        </div>
    </div>
    <p class="ml-4 text-sm text-gray-500">
        Foto ini akan muncul dalam profil anda, ayo pasang profile terbaikmu!
    </p>
</div>

<!-- Form Data Akun -->
<div class="space-y-6">
    <div>
        <p class="text-red-600 font-semibold text-sm">Username</p>
        <div class="flex items-center justify-between border-b pb-1">
            <span>{{ $user->nama_pengguna ?? 'Tidak Tersedia' }}</span>
            <i class="fas fa-pen text-gray-500 cursor-pointer"></i>
        </div>
    </div>

    <div>
        <p class="text-red-600 font-semibold text-sm">Nama Lengkap</p>
        <div class="flex items-center justify-between border-b pb-1">
            <span>{{ $user->nama_lengkap ?? 'Tidak Tersedia' }}</span>
            <i class="fas fa-pen text-gray-500 cursor-pointer"></i>
        </div>
    </div>

    <div>
        <p class="text-red-600 font-semibold text-sm">Email Anda</p>
        <div class="flex items-center justify-between border-b pb-1">
            <span>{{ $user->email ?? 'Tidak Tersedia' }}</span>
            <i class="fas fa-pen text-gray-500 cursor-pointer"></i>
        </div>
    </div>

    <div>
        <p class="text-red-600 font-semibold text-sm">Password Akun</p>
        <div class="flex items-center justify-between border-b pb-1">
            <span>********</span>
            <i class="fas fa-pen text-gray-500 cursor-pointer"></i>
        </div>
    </div>
</div>

<!-- Simpan Perubahan -->
<div class="mt-8">
    <button class="bg-red-500 text-white px-6 py-2 rounded shadow hover:bg-red-600">Simpan Perubahan</button>
    <p class="text-xs text-gray-500 mt-2">Mohon diperhatikan! perubahan yang dibuat tidak dapat dikembalikan</p>
</div>
