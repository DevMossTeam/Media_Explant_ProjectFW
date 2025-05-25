@extends('layouts.setting-layout')

@section('title', 'Hubungi Kami')

@section('setting-content')
    <div class="px-4 py-6 max-w-2xl mx-auto">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Hubungi Kami</h2>
        <p class="text-sm text-gray-500 mb-6 leading-relaxed">
            Jika Anda mengalami kendala atau memiliki pertanyaan terkait Media Explant, silakan kirimkan pesan Anda
            melalui formulir di bawah ini.
        </p>

        <!-- Form -->
        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Pesan -->
            <textarea name="pesan" rows="4"
                class="w-full p-4 bg-gray-100 text-sm text-gray-700 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-600 resize-none"
                placeholder="Tulis pesan Anda di sini..."></textarea>

            <!-- Upload Gambar -->
            <div x-data="{ isDragging: false, fileName: '' }"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="isDragging = false"
                class="w-full border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-white transition"
                :class="isDragging ? 'bg-gray-100 border-red-600' : ''">

                <input type="file" name="gambar"
                    accept="image/png, image/jpeg"
                    class="hidden" id="uploadGambar"
                    @change="fileName = $event.target.files.length ? $event.target.files[0].name : ''; validateFile($event.target)">

                <label for="uploadGambar" class="cursor-pointer text-sm text-gray-600">
                    <span class="block font-medium mb-1">Unggah Gambar (opsional)</span>
                    <span class="text-xs text-gray-400">Format PNG/JPG, maksimal 10MB</span>
                </label>

                <template x-if="fileName">
                    <p class="mt-2 text-xs text-gray-500">File dipilih: <span x-text="fileName"></span></p>
                </template>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-red-600 text-white text-sm font-semibold py-2 rounded-lg hover:bg-red-700 transition">
                Kirim Pesan
            </button>
        </form>

        <!-- Info Kontak -->
        <p class="text-xs text-gray-400 mt-6 text-center leading-relaxed">
            Kami akan merespons Anda melalui email atau Anda dapat menghubungi kami langsung melalui
            email resmi kami di <span class="text-gray-500">ukpmexplant@journalist.com</span>.
        </p>
    </div>

    <!-- Script Validasi -->
    <script>
        function validateFile(input) {
            const file = input.files[0];
            if (!file) return;

            const allowedTypes = ['image/jpeg', 'image/png'];
            const maxSize = 10 * 1024 * 1024; // 10MB

            if (!allowedTypes.includes(file.type)) {
                alert('Hanya format PNG dan JPG yang diperbolehkan.');
                input.value = '';
                return;
            }

            if (file.size > maxSize) {
                alert('Ukuran file maksimal 10MB.');
                input.value = '';
            }
        }
    </script>
@endsection
