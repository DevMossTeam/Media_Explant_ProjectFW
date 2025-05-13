<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-yadaYadaHashKey" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet" />

<form id="profileForm" method="POST" action="{{ route('settings.save.profile') }}">
    @csrf

    <h2 class="text-red-600 font-bold mb-6 text-lg">Profile Akun Anda</h2>

    <div class="flex items-center mb-6">
        <div class="relative w-24 h-24 flex-shrink-0">
            @php $previewPic = session('temp_profile_pic'); @endphp

            <div id="profilePreviewContainer" class="w-24 h-24 relative">
                @if ($previewPic)
                    <img src="data:image/jpeg;base64,{{ $previewPic }}" id="profilePreview"
                        class="w-24 h-24 object-cover rounded-full border-4 border-red-500" alt="Preview">
                @elseif ($user && $user->profile_pic)
                    <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_pic) }}" id="profilePreview"
                        class="w-24 h-24 object-cover rounded-full border-4 border-red-500" alt="Profile Picture">
                @else
                    <div id="defaultProfileIcon"
                        class="w-24 h-24 rounded-full border-4 border-red-500 bg-[#2c3440] flex items-center justify-center">
                        <i class="fa-solid fa-user text-white text-6xl"></i>
                    </div>
                @endif
            </div>

            <div class="absolute bottom-0 right-0 cursor-pointer">
                <label for="uploadProfilePic">
                    <div
                        class="w-10 h-10 bg-red-500 rounded-full border-4 border-white flex items-center justify-center">
                        <i class="fas fa-camera text-white text-sm"></i>
                    </div>
                </label>
                <input type="file" name="profile_pic" id="uploadProfilePic" accept="image/*" class="hidden">
            </div>
        </div>
        <p class="ml-4 text-sm text-gray-500">
            Foto ini akan muncul dalam profil anda, ayo pasang profile terbaikmu!
        </p>
    </div>

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

    <div class="mt-8">
        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded shadow hover:bg-red-600">
            Simpan Perubahan
        </button>
        <p class="text-xs text-gray-500 mt-2">Mohon diperhatikan! perubahan yang dibuat tidak dapat dikembalikan</p>
    </div>
</form>

<script>
    document.getElementById('uploadProfilePic').addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('profile_pic', file);

        fetch('{{ route('settings.upload.profile_pic') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        let preview = document.getElementById('profilePreview');
                        if (preview) {
                            preview.src = e.target.result;
                        } else {
                            preview = document.createElement('img');
                            preview.id = 'profilePreview';
                            preview.src = e.target.result;
                            preview.className =
                                'w-24 h-24 object-cover rounded-full border-4 border-red-500';

                            const container = document.querySelector('#profilePreviewContainer');
                            if (container) {
                                container.replaceWith(preview);
                            }
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert('Gagal upload gambar!');
                }
            })
            .catch(error => {
                console.error('Upload error:', error);
                alert('Terjadi kesalahan saat upload gambar.');
            });
    });
</script>
