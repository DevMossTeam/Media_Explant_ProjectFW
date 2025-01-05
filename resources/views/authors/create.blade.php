@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Buat Artikel Baru</h1>

    <form action="#" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        <!-- Simulasi CSRF -->
        <input type="hidden" name="_token" value="csrf_token_placeholder">

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Judul</label>
            <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Masukkan judul artikel" required>
        </div>
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold mb-2">Konten</label>
            <div id="quillEditor" class="w-full border border-gray-300 rounded-lg px-4 py-2" style="height: 250px;"></div>
            <input type="hidden" name="content" id="content">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">Simpan</button>
        </div>
    </form>
</div>

<!-- Tambahkan Quill.js -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    // Sembunyikan animasi loading saat halaman dimuat
    window.addEventListener('load', function() {
        document.getElementById('loading').classList.add('hidden');
    });

    // Memaksa refresh halaman jika dimuat dari cache
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    });

    const quill = new Quill('#quillEditor', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: [
                    [{ 'font': [] }, { 'size': [] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'sub' }, { 'script': 'super' }],
                    [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                    [{ 'direction': 'rtl' }, { 'align': [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ],
                handlers: {
                    video: function() {
                        // Trigger click on the hidden file input
                        document.getElementById('videoInput').click();
                    },
                    link: function() {
                        const range = quill.getSelection();
                        if (range) {
                            const url = prompt('Masukkan URL:');
                            if (url) {
                                quill.format('link', url);
                            }
                        } else {
                            alert('Silakan pilih teks atau gambar yang ingin Anda tambahkan tautan.');
                        }
                    }
                }
            }
        }
    });

    // Simpan konten editor ke dalam input hidden saat form disubmit
    document.querySelector('form').addEventListener('submit', function (e) {
        const content = document.querySelector('#content');
        content.value = quill.root.innerHTML;
    });
</script>
@endsection
