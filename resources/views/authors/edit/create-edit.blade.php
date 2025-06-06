@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Edit Berita</h2>

        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-6">
                <label for="judul" class="block text-sm font-bold text-gray-700">Judul</label>
                <input type="text" name="judul" id="judul" value="{{ $berita->judul }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
            </div>

            <!-- Konten Berita -->
            <div class="mb-6">
                <label for="konten_berita" class="block text-sm font-bold text-gray-700">Konten Berita</label>
                <div id="quillEditor" class="bg-white h-64"></div>
                <input type="hidden" name="konten_berita" id="konten_berita">
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label for="kategori" class="block text-sm font-bold text-gray-700">Kategori</label>
                <p class="text-sm text-gray-500 mb-2">Menambah kategori untuk mempermudah pencarian berita.</p>
                <select id="kategori" name="kategori" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                    @foreach (['Kampus', 'Nasional', 'Internasional', 'Liputan Khusus', 'Opini', 'Esai', 'Teknologi', 'Kesenian', 'Kesehatan', 'Olahraga', 'Hiburan'] as $kategori)
                        <option value="{{ $kategori }}" {{ $berita->kategori === $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tag -->
            <div class="mb-6">
                <label for="tags" class="block text-sm font-bold text-gray-700">Tambahkan Tag</label>
                <p class="text-sm text-gray-500 mb-2">Tambahkan tag untuk membantu pembaca menemukan berita.</p>
                <div id="tagContainer" class="flex flex-wrap border rounded-md p-2 gap-2 bg-white shadow-inner">
                    @if ($berita->tags)
                        @foreach ($berita->tags as $tag)
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded">{{ $tag->nama_tag }}</span>
                        @endforeach
                    @endif
                    <input type="text" id="tagInput"
                        class="flex-grow focus:outline-none px-2 py-1 rounded-md focus:ring-red-500 focus:border-red-500"
                        placeholder="Ketik dan tekan ',' untuk menambahkan tag">
                </div>
                <input type="hidden" id="tagsHidden" name="tags">
            </div>

            <!-- Visibilitas -->
            <div class="mb-6">
                <span class="block text-sm font-bold text-gray-700">Visibilitas</span>
                <p class="text-sm text-gray-500 mb-2">Atur visibilitas berita agar dapat dilihat oleh kelompok yang
                    diinginkan.</p>
                <div class="mt-3 flex items-center space-x-4">
                    <label class="flex items-center text-gray-700">
                        <input type="radio" name="visibilitas" value="public" required
                            class="h-4 w-4 text-red-600 border-gray-300 focus:ring-red-500"
                            {{ $berita->visibilitas === 'public' ? 'checked' : '' }}>
                        <span class="ml-2">Public</span>
                    </label>
                    <label class="flex items-center text-gray-700">
                        <input type="radio" name="visibilitas" value="private" required
                            class="h-4 w-4 text-red-600 border-gray-300 focus:ring-red-500"
                            {{ $berita->visibilitas === 'private' ? 'checked' : '' }}>
                        <span class="ml-2">Private</span>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Perbarui
                </button>
            </div>
        </form>
    </div>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Script tag input jika dinamis -->
    <script>
        // Inisialisasi Quill Editor
        const quill = new Quill('#quillEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'font': []
                    }, {
                        'size': []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'header': '1'
                    }, {
                        'header': '2'
                    }, 'blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }, {
                        'align': []
                    }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            },
            placeholder: 'Tulis konten berita di sini...',
        });

        // Set konten awal jika ada dari server
        quill.root.innerHTML = {!! json_encode($berita->konten_berita ?? '') !!};

        // Sebelum submit, ambil konten plain text + gambar
        document.querySelector('form').onsubmit = function() {
            const delta = quill.getContents();
            let output = '';

            delta.ops.forEach(op => {
                if (typeof op.insert === 'string') {
                    output += op.insert;
                } else if (op.insert.image) {
                    output += `[img]${op.insert.image}[/img]`; // format gambar custom
                }
            });

            document.getElementById('konten_berita').value = output;
        };

        const tagInput = document.getElementById('tagInput');
        const tagContainer = document.getElementById('tagContainer');
        const tagsHidden = document.getElementById('tagsHidden');
        let tags = [];

        tagInput.addEventListener('keydown', function(e) {
            if (e.key === ',' || e.key === 'Enter') {
                e.preventDefault();
                const tag = tagInput.value.trim().replace(',', '');
                if (tag !== '') {
                    tags.push(tag);
                    const span = document.createElement('span');
                    span.textContent = tag;
                    span.className = 'bg-red-100 text-red-700 px-2 py-1 rounded';
                    tagContainer.insertBefore(span, tagInput);
                    tagInput.value = '';
                    tagsHidden.value = tags.join(',');
                }
            }
        });
    </script>
@endsection
