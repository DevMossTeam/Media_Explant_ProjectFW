@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 lg:px-16">
    <!-- Form Penulisan Artikel dan Pengaturan Publikasi -->
    <form id="createArticleForm" method="POST" action="{{ route('author.artikel.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="lg:flex lg:space-x-8">
            <!-- Form Penulisan Artikel -->
            <div class="lg:w-2/3 bg-white shadow-lg rounded-lg p-6 lg:p-8 mb-8 md:mb-10">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">📝 Form Penulisan Artikel</h2>

                <!-- Judul -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-bold text-gray-700">Judul</label>
                    <input type="text" id="judul" name="judul" maxlength="100" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500"
                        placeholder="Masukkan judul artikel...">
                </div>

                <!-- Konten Artikel -->
                <div class="mb-6">
                    <label for="konten_artikel" class="block text-sm font-bold text-gray-700">Konten Artikel</label>
                    <div id="quillEditor" class="border rounded-md" style="height: 300px;"></div>
                    <textarea id="konten_artikel" name="konten_artikel" hidden></textarea>
                </div>
            </div>

            <!-- Pengaturan Publikasi -->
            <div class="lg:w-1/3 bg-gray-50 shadow-md rounded-lg p-6 lg:p-8 mb-8 md:mb-10">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">⚙️ Pengaturan Publikasi</h2>

                <!-- Kategori -->
                <div class="mb-6">
                    <label for="kategori" class="block text-sm font-bold text-gray-700">Kategori</label>
                    <p class="text-sm text-gray-500 mb-2">Menambah kategori untuk mempermudah pencarian artikel.</p>
                    <select id="kategori" name="kategori" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                        <option value="Siaran Pers">Siaran Pers</option>
                        <option value="Riset">Riset</option>
                        <option value="Wawancara">Wawancara</option>
                        <option value="Diskusi">Diskusi</option>
                        <option value="Agenda">Agenda</option>
                        <option value="Sastra">Sastra</option>
                        <option value="Opini">Opini</option>
                    </select>
                </div>

                <!-- Tag -->
                <div class="mb-6">
                    <label for="tags" class="block text-sm font-bold text-gray-700">Tambahkan Tag</label>
                    <p class="text-sm text-gray-500 mb-2">Tambahkan tag untuk membantu pembaca menemukan artikel.</p>
                    <div id="tagContainer" class="flex flex-wrap border rounded-md p-2 gap-2 bg-white shadow-inner">
                        <input type="text" id="tagInput"
                            class="flex-grow focus:outline-none px-2 py-1 rounded-md focus:ring-red-500 focus:border-red-500"
                            placeholder="Ketik dan tekan ',' untuk menambahkan tag">
                    </div>
                    <input type="hidden" id="tagsHidden" name="tags">
                </div>

                <!-- Visibilitas -->
                <div class="mb-6">
                    <span class="block text-sm font-bold text-gray-700">Visibilitas</span>
                    <p class="text-sm text-gray-500 mb-2">Atur visibilitas artikel agar dapat dilihat oleh kelompok yang diinginkan.</p>
                    <div class="mt-3 flex items-center space-x-4">
                        <label class="flex items-center text-gray-700">
                            <input type="radio" id="public" name="visibilitas" value="public" required
                                class="h-4 w-4 text-red-600 border-gray-300 focus:ring-red-500">
                            <span class="ml-2">Public</span>
                        </label>
                        <label class="flex items-center text-gray-700">
                            <input type="radio" id="private" name="visibilitas" value="private" required
                                class="h-4 w-4 text-red-600 border-gray-300 focus:ring-red-500">
                            <span class="ml-2">Private</span>
                        </label>
                    </div>
                </div>

                <!-- Tanggal Diterbitkan -->
                <input type="hidden" name="tanggal_diterbitkan" value="{{ now() }}">

                <!-- Buttons -->
                <div class="mt-8 flex justify-between">
                    <!-- Pratinjau -->
                    <button type="button" id="previewArticle"
                        class="flex items-center px-6 py-3 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10l4.553 2.276A12.042 12.042 0 0115 12m0 0l-4.553 2.276A12.042 12.042 0 009 12m6 0v-4a4 4 0 00-8 0v4m4 10v-4m0-16h0" />
                        </svg>
                        Pratinjau
                    </button>

                    <!-- Publikasikan -->
                    <button type="button" id="submitArticle"
                        class="flex items-center px-6 py-3 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Publikasikan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div id="modalAlert" class="fixed inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white w-96 rounded-lg shadow-lg p-6">
        <div id="modalMessage" class="text-lg font-medium text-gray-800 mb-4"></div>
        <div class="flex justify-end">
            <button id="closeModal"
                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none">
                Tutup
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<script>
    // Inisialisasi Quill
    const quill = new Quill('#quillEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'font': [] }, { 'size': [] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }, { 'align': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        },
        placeholder: 'Tulis konten artikel di sini...',
    });

    const modal = document.getElementById('modalAlert');
    const modalMessage = document.getElementById('modalMessage');
    const closeModal = document.getElementById('closeModal');

    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    function showModal(message) {
        modalMessage.textContent = message;
        modal.classList.remove('hidden');
    }

    // Simpan data Quill ke textarea sebelum submit
    document.getElementById('submitArticle').addEventListener('click', () => {
        const konten = quill.root.innerHTML;
        document.getElementById('konten_artikel').value = konten;

        if (konten.trim() === '' || konten.length > 65535) {
            showModal('Konten tidak boleh kosong dan harus kurang dari 65535 karakter.');
        } else if (tags.length === 0) {
            showModal('Tambahkan setidaknya satu tag sebelum mempublikasikan.');
        } else {
            document.getElementById('createArticleForm').submit();
        }
    });

    // Tag
    const tagInput = document.getElementById('tagInput');
    const tagContainer = document.getElementById('tagContainer');
    const tagsHidden = document.getElementById('tagsHidden');
    const tags = [];

    tagInput.addEventListener('keydown', (e) => {
        if (e.key === ',') {
            e.preventDefault();
            const tagValue = tagInput.value.trim();
            if (tagValue) {
                if (tags.length >= 10) {
                    showModal('Tidak dapat menambahkan lebih dari 10 tag.');
                    return;
                }
                if (tags.includes(tagValue)) {
                    showModal('Tag sudah ada.');
                    return;
                }
                if (tagValue.length > 15) {
                    showModal('Tag tidak boleh lebih dari 15 karakter.');
                    return;
                }
                tags.push(tagValue);
                addTagElement(tagValue);
                updateHiddenTags();
            }
            tagInput.value = '';
        }
    });

    function addTagElement(tagValue) {
        const tagEl = document.createElement('div');
        tagEl.className = 'flex items-center bg-gray-200 px-3 py-1 rounded-full text-sm';
        tagEl.innerHTML = `
            <span>${tagValue}</span>
            <button type="button" class="ml-2 text-gray-600 focus:outline-none">&times;</button>
        `;
        tagEl.querySelector('button').addEventListener('click', () => {
            removeTag(tagValue);
        });
        tagContainer.insertBefore(tagEl, tagInput);

        if (tags.length >= 10) {
            tagInput.disabled = true;
        }
    }

    function removeTag(tagValue) {
        tags.splice(tags.indexOf(tagValue), 1);
        updateHiddenTags();
        Array.from(tagContainer.children).forEach((child) => {
            if (child.innerText.includes(tagValue)) {
                child.remove();
            }
        });
        tagInput.disabled = tags.length >= 10 ? true : false;
    }

    function updateHiddenTags() {
        tagsHidden.value = tags.join(',');
    }
</script>
@endsection
