<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-yadaYadaHashKey" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.js"></script>
<h2 class="text-red-600 font-bold mb-6 text-lg">Profile Akun Anda</h2>

<!-- Foto Profil -->
<div class="flex items-center mb-6">
    <div class="relative w-24 h-24 flex-shrink-0">
        @php
            $previewPic = session('temp_profile_pic');
        @endphp

        @if ($previewPic)
            <img src="data:image/jpeg;base64,{{ $previewPic }}"
                class="w-24 h-24 object-cover rounded-full border-4 border-red-500" alt="Preview">
        @elseif ($user->profile_pic)
            <img src="{{ asset($user->profile_pic) }}"
                class="w-24 h-24 object-cover rounded-full border-4 border-red-500" alt="Profile Picture">
        @else
            <div class="w-24 h-24 rounded-full border-4 border-red-500 bg-[#2c3440] flex items-center justify-center">
                <i class="fa-solid fa-user text-white text-6xl"></i>
            </div>
        @endif

        <!-- Icon Kamera dengan Dropdown -->
        <div class="absolute bottom-0 right-0">
            <div class="relative group">
                <div
                    class="w-10 h-10 bg-red-500 rounded-full border-4 border-white flex items-center justify-center cursor-pointer">
                    <i class="fas fa-camera text-white text-sm"></i>
                </div>
                <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white border rounded shadow z-50">
                    @if ($user->profile_pic)
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100"
                            onclick="handleChangeProfile()">Ganti Foto Profil</button>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-500"
                            onclick="handleDeleteProfile()">Hapus Foto Profil</button>
                    @else
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100"
                            onclick="handleAddProfile()">Tambahkan Foto Profil</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <p class="ml-4 text-sm text-gray-500">
        Foto ini akan muncul dalam profil anda, ayo pasang profile terbaikmu!
    </p>
</div>

<!-- Input file tersembunyi -->
<input type="file" id="profileInput" accept="image/*" class="hidden" onchange="previewProfile(this)">

<!-- Modal untuk Crop dan Preview -->
<div id="cropModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-4 rounded shadow-lg w-96">
        <div class="mb-4">
            <div id="imagePreview" class="w-full h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
                <!-- Image cropping will appear here -->
                <img id="cropImage" src="" alt="Preview" class="max-w-full hidden">
            </div>
        </div>
        <div class="flex justify-end space-x-2">
            <button onclick="cancelCrop()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
            <button onclick="confirmCrop()" class="px-4 py-2 bg-red-500 text-white rounded">Konfirmasi</button>
        </div>
    </div>
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

<script>
    let cropper;

    function handleAddProfile() {
        document.getElementById('profileInput').click();
    }

    function handleChangeProfile() {
        document.getElementById('profileInput').click();
    }

    function handleDeleteProfile() {
        if (confirm("Yakin ingin menghapus foto profil?")) {
            fetch('/settings/delete-profile-pic', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => location.reload());
        }
    }

    function previewProfile(input) {
        const file = input.files[0];
        if (file) {
            const url = URL.createObjectURL(file);
            document.getElementById('cropImage').src = url;
            document.getElementById('cropImage').classList.remove('hidden');
            document.getElementById('cropModal').classList.remove('hidden');

            cropper = new Cropper(document.getElementById('cropImage'), {
                aspectRatio: 1,
                viewMode: 1,
                zoomable: true,
                scalable: true,
            });
        }
    }

    function cancelCrop() {
        document.getElementById('cropModal').classList.add('hidden');
        cropper.destroy();
    }

    function confirmCrop() {
        cropper.getCroppedCanvas().toBlob(blob => {
            const formData = new FormData();
            formData.append('profile_pic', blob);

            fetch('/settings/temp-preview', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData
                }).then(res => res.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // reload to show preview
                    }
                });
        });
        document.getElementById('cropModal').classList.add('hidden');
        cropper.destroy();
    }
</script>
