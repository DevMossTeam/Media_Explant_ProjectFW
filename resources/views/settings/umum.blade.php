@extends('layouts.setting-layout')

@section('title', 'Pengaturan Umum')

@section('setting-content')
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
                <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_pic) }}"
                    class="w-24 h-24 object-cover rounded-full border-4 border-red-500" alt="Foto Profil">
            @else
                <div
                    class="w-24 h-24 flex items-center justify-center rounded-full border-4 border-red-500 bg-gray-200 text-gray-500">
                    <i class="fa-solid fa-user-circle text-5xl"></i>
                </div>
            @endif

            <div class="absolute bottom-0 right-0 bg-red-500 rounded-full p-1 cursor-pointer">
                <i class="fas fa-camera text-white text-xs"></i>
            </div>
        </div>
        <p class="ml-4 text-sm text-gray-500">Foto ini akan muncul dalam profil anda, ayo pasang profile terbaikmu!</p>
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
                <i onclick="showEmailModal()" class="fas fa-pen text-gray-500 cursor-pointer hover:text-blue-600"
                    title="Ubah Email"></i>
            </div>
        </div>

        <div>
            <p class="text-red-600 font-semibold text-sm">Password Akun</p>
            <div class="flex items-center justify-between border-b pb-1">
                <span>********</span>
                <i onclick="showPasswordModal()" class="fas fa-pen text-gray-500 cursor-pointer hover:text-blue-600"
                    title="Ubah Password"></i>
            </div>
        </div>
    </div>

    <!-- Simpan Perubahan -->
    <div class="mt-8">
        <form method="POST" action="{{ route('settings.save.profile') }}">
            @csrf
            <button class="bg-red-500 text-white px-6 py-2 rounded shadow hover:bg-red-600">Simpan Perubahan</button>
        </form>
        <p class="text-xs text-gray-500 mt-2">Mohon diperhatikan! perubahan yang dibuat tidak dapat dikembalikan</p>
    </div>

    <!-- Modal untuk Verifikasi Email -->
    <div id="emailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md text-center">
            <img src="https://img.icons8.com/ios-filled/50/000000/verified-account.png" alt="Verified Icon"
                class="mx-auto mb-4" />
            <h2 class="text-xl font-bold mb-4">Verifikasi Email</h2>
            <p class="text-gray-700 mb-4">Untuk melanjutkan, kami perlu memverifikasi email Anda. Klik tombol di bawah untuk
                mengirim kode verifikasi ke email Anda saat ini.</p>
            <form method="POST" action="{{ route('settings.sendOtpToCurrentEmail') }}"
                onsubmit="setTimeout(() => showOtpModal(), 100);">
                @csrf
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeEmailModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded">Tutup</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim Kode Verifikasi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal untuk Memasukkan Kode OTP -->
    <div id="otpModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md text-center">
            <img src="https://img.icons8.com/ios-filled/50/000000/lock.png" alt="OTP Icon" class="mx-auto mb-4" />
            <h2 class="text-xl font-bold mb-4">Masukkan Kode OTP</h2>
            <p class="text-gray-700 mb-4">Kami telah mengirimkan kode OTP ke email Anda. Silakan masukkan kode tersebut di
                bawah ini untuk melanjutkan.</p>
            <form method="POST" action="{{ route('settings.verifyOtp') }}">
                @csrf
                <div class="flex justify-center mb-6">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" name="otp[]" maxlength="1"
                            class="w-12 h-12 border-2 border-gray-300 rounded text-center mx-1 otp-input" required>
                    @endfor
                </div>
                <div class="flex justify-end space-x-2">
                    @if (session('otpFor') === 'currentEmail')
                        <button type="button" onclick="closeOtpModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                    @endif
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Verifikasi</button>
                </div>
            </form>

            @if (session('otpError'))
                <p class="text-red-500 text-sm mt-2 text-center">{{ session('otpError') }}</p>
            @endif
        </div>
    </div>

    <!-- Modal untuk Memasukkan Email Baru -->
    <div id="newEmailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md text-center">
            <img src="https://img.icons8.com/ios-filled/50/000000/edit.png" alt="Edit Icon" class="mx-auto mb-4" />
            <h2 class="text-xl font-bold mb-4">Masukkan Email Baru</h2>
            <p class="text-gray-700 mb-4">Silakan masukkan email baru Anda dan konfirmasi dengan kata sandi terakhir Anda
                untuk memperbarui informasi email Anda.</p>
            <form method="POST" action="{{ route('settings.updateEmail') }}">
                @csrf
                <input type="email" name="newEmail" placeholder="Email Baru"
                    class="w-full p-2 border border-gray-300 rounded mb-4" required>
                <input type="password" name="currentPassword" placeholder="Kata Sandi Terakhir"
                    class="w-full p-2 border border-gray-300 rounded mb-4" required>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeNewEmailModal(); showOtpModal();"
                        class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui Email</button>
                </div>
            </form>

            @if (session('error'))
                <div class="text-red-500 mt-4">{{ session('error') }}</div>
            @elseif (session('success'))
                <div class="text-green-500 mt-4">{{ session('success') }}</div>
            @endif
        </div>
    </div>

    <!-- Modal untuk Sukses Memperbarui Email -->
    @if (session('success') && session('otpFor') === 'newEmail')
        <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md text-center">
                <img src="https://img.icons8.com/ios-filled/50/000000/checked.png" alt="Success Icon"
                    class="mx-auto mb-4" />
                <h2 class="text-xl font-bold mb-4">Sukses</h2>
                <p class="text-gray-700 mb-4">Email Anda telah berhasil diperbarui. Terima kasih telah memperbarui
                    informasi Anda.</p>
                <button type="button" onclick="closeSuccessModal()"
                    class="bg-blue-500 text-white px-4 py-2 rounded">Selesai</button>
            </div>
        </div>
    @endif

    <!-- Modal untuk Mengubah Kata Sandi -->
    <div id="passwordModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 {{ session('showPasswordModal') || $errors->any() ? 'flex' : 'hidden' }} flex justify-center items-center transition-opacity duration-300">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md text-center overflow-y-auto max-h-screen">
            <h2 class="text-xl font-bold mb-4">Ubah Kata Sandi</h2>
            <p class="text-gray-700 mb-4">Untuk keamanan akun Anda, silakan masukkan kata sandi lama Anda dan buat kata
                sandi baru yang kuat.</p>

            <form method="POST" action="{{ route('settings.updatePassword') }}">
                @csrf
                <input type="password" name="oldPassword" placeholder="Kata Sandi Lama"
                    class="w-full p-2 border border-gray-300 rounded mb-4" required>
                <input type="password" name="newPassword" placeholder="Kata Sandi Baru"
                    class="w-full p-2 border border-gray-300 rounded mb-4" required>
                <input type="password" name="newPassword_confirmation" placeholder="Konfirmasi Kata Sandi Baru"
                    class="w-full p-2 border border-gray-300 rounded mb-4" required>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closePasswordModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui Kata Sandi</button>
                </div>
            </form>

            @if ($errors->any())
                <div class="text-red-500 mt-4 text-left space-y-1">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="text-red-500 mt-4">{{ session('error') }}</div>
            @endif

            @if (session('success') && !session('showPasswordSuccessModal'))
                <div class="text-green-500 mt-4">{{ session('success') }}</div>
            @endif
        </div>
    </div>

    <!-- Modal untuk Sukses Memperbarui Kata Sandi -->
    @if (session('success') && session('showPasswordSuccessModal'))
        <div id="passwordSuccessModal"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md text-center">
                <img src="https://img.icons8.com/ios-filled/50/000000/checked.png" alt="Success Icon"
                    class="mx-auto mb-4" />
                <h2 class="text-xl font-bold mb-4">Sukses</h2>
                <p class="text-gray-700 mb-4">Kata sandi Anda telah berhasil diperbarui. Terima kasih telah memperbarui
                    informasi keamanan Anda.</p>
                <button type="button" onclick="closePasswordSuccessModal()"
                    class="bg-blue-500 text-white px-4 py-2 rounded">Selesai</button>
            </div>
        </div>
    @endif

    <script>
        function showEmailModal() {
            document.getElementById('emailModal').classList.remove('hidden');
        }

        function closeEmailModal() {
            document.getElementById('emailModal').classList.add('hidden');
        }

        function showOtpModal() {
            document.getElementById('otpModal').classList.remove('hidden');
        }

        function closeOtpModal() {
            document.getElementById('otpModal').classList.add('hidden');
        }

        function showNewEmailModal() {
            document.getElementById('newEmailModal').classList.remove('hidden');
        }

        function closeNewEmailModal() {
            document.getElementById('newEmailModal').classList.add('hidden');
        }

        function showPasswordModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').classList.add('hidden');
        }

        function showErrorModal(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorModal').classList.remove('hidden');
        }

        function closeErrorModal() {
            document.getElementById('errorModal').classList.add('hidden');
        }

        function showSuccessModal() {
            document.getElementById('successModal').classList.remove('hidden');
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.add('hidden');
        }

        function showPasswordSuccessModal() {
            document.getElementById('passwordSuccessModal').classList.remove('hidden');
        }

        function closePasswordSuccessModal() {
            document.getElementById('passwordSuccessModal').classList.add('hidden');
        }

        document.querySelectorAll('.otp-input').forEach((input, index, inputs) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && index > 0 && input.value.length === 0) {
                    inputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasteData = e.clipboardData.getData('text').replace(/\D/g, '');
                pasteData.split('').forEach((char, i) => {
                    if (i < inputs.length) {
                        inputs[i].value = char;
                    }
                });
                inputs[Math.min(pasteData.length, inputs.length) - 1].focus();
            });
        });

        // Inject PHP variables into JS safely
        const otpVerified = @json($otpVerified ?? false);
        const updateError = @json($updateError ?? null);
        const updateSuccess = @json($updateSuccess ?? false);
        const passwordUpdateError = @json($passwordUpdateError ?? false);
        const passwordUpdateSuccess = @json($passwordUpdateSuccess ?? false);

        if (otpVerified) {
            closeOtpModal();
            showSuccessModal();
        }

        if (updateError) {
            showErrorModal(updateError);
        } else if (updateSuccess) {
            showSuccessModal();
        }

        if (passwordUpdateError) {
            document.addEventListener('DOMContentLoaded', function() {
                showPasswordModal();
            });
        }

        if (passwordUpdateSuccess) {
            document.addEventListener('DOMContentLoaded', function() {
                closePasswordModal();
                showPasswordSuccessModal();
            });
        }
    </script>

    {{-- Tambahan logika modal berdasarkan session Laravel --}}
    @if (session('success') && session('otpFor') === 'currentEmail')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                closeEmailModal();
                showOtpModal();
            });
        </script>
    @endif

    @if (session('error') && session('otpFor') === 'currentEmail')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showEmailModal();
            });
        </script>
    @endif

    @if (session('showOtpModal'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('otpModal').classList.remove('hidden');
            });
        </script>
    @endif

    @if (session('otpError'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showOtpModal();
            });
        </script>
    @endif

    @if (session('showNewEmailModal'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showNewEmailModal();
            });
        </script>
    @endif

    @if (session('success') && session('otpFor') === 'newEmail')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                closeNewEmailModal();
                showSuccessModal();
            });
        </script>
    @endif

@endsection
