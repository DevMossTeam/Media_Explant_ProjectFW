<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Explant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/ukpm-explant-ic.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Cr4+r8mV7E6KjL1PjIuFBo8zpq7wcmI7NY+qd7t3Kh1qI2tWPNWs9TzXH7dKSUg77Km3gHAGeA+8U45mclCy5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100">
    <!-- Header -->
    @include('header-footer.header')

    <!-- Konten Utama -->
    @yield('content')

    <!-- Footer -->
    @include('header-footer.footer')

    <!-- Modal Settings -->
    <div id="settingsModal"
        class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center sm:items-start sm:pt-10 overflow-y-auto">
        <div
            class="bg-white w-full max-w-4xl sm:max-h-[90vh] mx-4 sm:mx-auto rounded-lg shadow-lg flex flex-col sm:h-[90vh]">

            <!-- Header Modal -->
            <div class="flex items-center justify-between px-6 py-4 border-b bg-white z-10">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/Medex-M-IC.png') }}" alt="Logo" class="w-6 h-6">
                    <h2 class="text-xl font-bold text-red-600">Pengaturan</h2>
                </div>
                <button onclick="closeSettingsModal()" class="text-gray-600 hover:text-red-600 text-2xl font-bold">
                    &times;
                </button>
            </div>

            <!-- Isi Modal -->
            <div class="flex flex-col sm:flex-row flex-1 overflow-hidden">
                <!-- Sidebar -->
                <div class="w-full sm:w-1/3 bg-gray-100 p-4 border-r overflow-y-auto max-h-[calc(90vh-4rem)]">
                    <a href="javascript:void(0)" onclick="loadSettingContent('umum')"
                        class="block py-2 text-gray-600 hover:text-blue-600" id="link-umum">
                        <i class="fas fa-user mr-2"></i>Akun
                    </a>
                    <a href="javascript:void(0)" onclick="loadSettingContent('notifikasi')"
                        class="block py-2 text-gray-600 hover:text-blue-600" id="link-notifikasi">
                        <i class="fas fa-bell mr-2"></i>Notifikasi
                    </a>
                    <a href="javascript:void(0)" onclick="loadSettingContent('bantuan')"
                        class="block py-2 text-gray-600 hover:text-blue-600" id="link-bantuan">
                        <i class="fas fa-question-circle mr-2"></i>Pusat Bantuan
                    </a>
                </div>

                <!-- Konten -->
                <div class="w-full sm:w-2/3 p-6 overflow-y-auto sm:max-h-full" id="setting-content">
                    <!-- Konten dinamis dimuat di sini -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function openSettingsModal() {
            document.getElementById('settingsModal').classList.remove('hidden');
            loadSettingContent('umum'); // default load
        }

        function closeSettingsModal() {
            document.getElementById('settingsModal').classList.add('hidden');
        }

        function loadSettingContent(menu) {
            fetch(`/settings/modal/${menu}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('setting-content').innerHTML = html;
                    updateActiveLink(menu);
                    history.pushState(null, '', `/settings/${menu}`);
                });
        }

        function updateActiveLink(activeMenu) {
            ['umum', 'notifikasi', 'bantuan'].forEach(menu => {
                const link = document.getElementById(`link-${menu}`);
                if (menu === activeMenu) {
                    link.classList.add('text-blue-600', 'font-semibold');
                } else {
                    link.classList.remove('text-blue-600', 'font-semibold');
                }
            });
        }
    </script>
</body>

</html>
