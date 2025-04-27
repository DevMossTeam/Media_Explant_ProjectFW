@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <main class="py-1">
        <div
            class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 py-6 max-w-screen-2xl flex flex-col lg:flex-row gap-8">
            <!-- Konten Kiri -->
            <div class="w-full lg:w-3/5">
                <!-- Label Kategori -->
                <div class="flex flex-col mb-8">
                    <div class="flex items-center">
                        <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                        <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]"
                            style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                            {{ $news->kategori }}
                        </h2>
                    </div>
                    <div class="w-full h-[2px] bg-gray-300"></div>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">{{ $news->judul }}</h1>
                <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                    <div>
                        Oleh: {{ $news->user->nama_lengkap ?? 'Tidak Diketahui' }} -
                        {{ \Carbon\Carbon::parse($news->tanggal_diterbitkan)->format('d F Y - H.i') }} WIB
                    </div>
                    <button class="flex items-center gap-2 text-gray-400 hover:text-gray-800">
                        <span class="text-sm">Simpan dan baca nanti</span>
                        <i class="far fa-bookmark text-xl"></i>
                    </button>
                </div>

                @if (!str_contains($news->konten_berita, '<img'))
                    <div class="mb-6">
                        <img src="{{ $news->first_image }}" alt="Gambar Ilustrasi"
                            class="rounded-lg shadow-md w-full max-w-full mx-auto pointer-events-none select-none">
                    </div>
                @endif

                {!! preg_replace(
                    ['/<a[^>]*>\s*(<img[^>]*>)\s*<\/a>/i', '/<img(.*?)>/i'],
                    ['$1', '<img$1 class="mx-auto pointer-events-none select-none mb-6 rounded-lg w-full h-auto">'],
                    $news->konten_berita,
                ) !!}

                <!-- Tanggapan -->
                <div class="mt-5" data-news-id="{{ $news->id }}">
                    <div class="text-sm font-semibold text-black mb-2">Beri Tanggapanmu :</div>
                    <div class="flex items-center gap-6 text-[#ABABAB]">
                        <button id="likeButton" class="flex items-center gap-2 hover:text-gray-700">
                            <i class="fas fa-thumbs-up"></i>
                            <span id="likeCount">{{ $news->reaksi->where('jenis_reaksi', 'Suka')->count() }}</span>
                        </button>
                        <button id="dislikeButton" class="flex items-center gap-2 hover:text-gray-700">
                            <i class="fas fa-thumbs-down"></i>
                            <span id="dislikeCount">{{ $news->reaksi->where('jenis_reaksi', 'Tidak Suka')->count() }}</span>
                        </button>

                        <!-- Tombol Share -->
                        <div class="relative">
                            <button id="openShareModal" class="flex items-center gap-2 hover:text-gray-700">
                                <i class="fas fa-share-nodes"></i> Share
                            </button>
                        </div>

                        <button class="ml-auto text-red-600 hover:text-red-800 bg-red-100 rounded-full p-2">
                            <i class="fas fa-flag"></i>
                        </button>
                    </div>
                </div>

                <!-- Komentar -->
                <div class="mt-5">
                    <form action="#" method="POST">
                        @csrf
                        <div class="relative w-full">
                            <input type="text" name="komentar" placeholder="Tulis komentarmu disini"
                                class="w-full border border-[#9A0605] rounded-full pr-12 pl-4 py-2 text-sm focus:outline-none" />
                            <button type="submit"
                                class="absolute right-0 top-0 bottom-0 w-10 flex items-center justify-center bg-[#9A0605] rounded-full rounded-l-none text-white hover:bg-red-800">
                                <i class="fas fa-paper-plane text-sm"></i>
                            </button>
                        </div>
                    </form>
                    <div class="mt-3 border border-gray-200 rounded-lg p-4 bg-gray-50 text-sm text-gray-500 text-center">
                        Belum Ada Komentar
                    </div>
                </div>
            </div>

            <!-- Konten Kanan -->
            <div class="w-full lg:w-2/5">
                @if (isset($relatedNews))
                    <div class="mb-6">
                        <div class="flex flex-col mb-4">
                            <div class="flex items-center">
                                <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                                <h3 class="text-white font-bold bg-[#9A0605] px-6 py-1 text-lg"
                                    style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                                    Berita Terkait
                                </h3>
                            </div>
                            <div class="w-full h-[2px] bg-gray-300"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($relatedNews as $item)
                                <div>
                                    <a href="?a={{ $item->id }}">
                                        <img src="{{ $item->thumbnail ?? $item->first_image }}"
                                            class="w-full h-36 object-cover rounded-md" alt="{{ $item->judul }}">
                                    </a>
                                    <a href="?a={{ $item->id }}">
                                        <div class="font-bold text-sm text-gray-700 mt-2">{{ $item->judul }}</div>
                                    </a>
                                    <div class="flex items-center gap-3 text-xs text-[#ABABAB] font-semibold mt-1">
                                        <span>{{ $item->user->nama_lengkap ?? '-' }}</span>
                                        <div class="flex gap-2">
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-thumbs-up"></i><span>107</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-solid fa-share-nodes"></i><span>Share</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (isset($recommendedNews))
                    <div class="mb-6">
                        <div class="flex flex-col mb-4">
                            <div class="flex items-center">
                                <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                                <h3 class="text-white font-bold bg-[#9A0605] px-6 py-1 text-lg"
                                    style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                                    Mungkin Anda Suka
                                </h3>
                            </div>
                            <div class="w-full h-[2px] bg-gray-300"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($recommendedNews as $item)
                                <div>
                                    <a href="?a={{ $item->id }}">
                                        <img src="{{ $item->thumbnail ?? $item->first_image }}"
                                            class="w-full h-36 object-cover rounded-md" alt="{{ $item->judul }}">
                                    </a>
                                    <a href="?a={{ $item->id }}">
                                        <div class="font-bold text-sm text-gray-700 mt-2">{{ $item->judul }}</div>
                                    </a>
                                    <div class="flex items-center gap-3 text-xs text-[#ABABAB] font-semibold mt-1">
                                        <span>{{ $item->user->nama_lengkap ?? '-' }}</span>
                                        <div class="flex gap-2">
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-thumbs-up"></i><span>107</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-solid fa-share-nodes"></i><span>Share</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if (isset($otherTopics))
            <div class="container mx-auto px-4 lg:px-16 xl:px-24 2xl:px-32 mt-10 mb-20">
                <div class="flex flex-col mb-4">
                    <div class="flex items-center">
                        <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                        <h3 class="text-white font-bold bg-[#9A0605] px-6 py-1 text-lg"
                            style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                            Topik Lainnya
                        </h3>
                    </div>
                    <div class="w-full h-[2px] bg-gray-300"></div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($otherTopics as $item)
                        <div>
                            <a href="?a={{ $item->id }}">
                                <img src="{{ $item->thumbnail ?? $item->first_image }}"
                                    class="w-full h-36 object-cover rounded-md" alt="{{ $item->judul }}">
                            </a>
                            <a href="?a={{ $item->id }}">
                                <div class="font-bold text-sm text-gray-700 mt-2">{{ $item->judul }}</div>
                            </a>
                            <div class="flex items-center gap-3 text-xs text-[#ABABAB] font-semibold mt-1">
                                <span>{{ $item->user->nama_lengkap ?? '-' }}</span>
                                <div class="flex gap-2">
                                    <div class="flex items-center gap-1">
                                        <i class="fa-regular fa-thumbs-up"></i><span>107</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <i class="fa-solid fa-share-nodes"></i><span>Share</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    <!-- Modal Share -->
    <div id="shareModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden">
        <div class="bg-[#212121] rounded-2xl p-6 w-full max-w-md relative">

            <!-- Tombol Close -->
            <button id="closeShareModal" class="absolute top-4 right-4 text-gray-400 hover:text-white text-2xl">
                &times;
            </button>

            <!-- Title -->
            <h2 class="text-white text-center text-xl font-semibold mb-6">Bagikan</h2>

            <!-- Wrapper Icon + Slide Button -->
            <div class="relative flex items-center">

                <!-- Tombol Slide Kiri -->
                <button id="slideLeft"
                    class="absolute left-0 z-10 bg-[#333] hover:bg-[#444] text-white p-2 rounded-full shadow-md">
                    &#10094;
                </button>

                <!-- Slide Icon Bagikan -->
                <div id="iconContainer"
                    class="flex overflow-x-auto space-x-6 px-10 py-2 scrollbar-none snap-x snap-mandatory">
                    <!-- WhatsApp -->
                    <a href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}" target="_blank"
                        class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/color/48/whatsapp.png" alt="WhatsApp" class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">WhatsApp</span>
                    </a>

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                        target="_blank" class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/color/48/facebook-new.png" alt="Facebook" class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">Facebook</span>
                    </a>

                    <!-- Twitter (X) -->
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank"
                        class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/ios-filled/50/000000/twitterx.png" alt="X"
                                class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">X</span>
                    </a>

                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($news->judul) }}"
                        target="_blank" class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/color/48/linkedin.png" alt="LinkedIn" class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">LinkedIn</span>
                    </a>

                    <!-- Email -->
                    <a href="mailto:?subject={{ urlencode($news->judul) }}&body={{ urlencode(request()->fullUrl()) }}"
                        target="_blank" class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/fluency/48/new-post.png" alt="Email" class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">Email</span>
                    </a>

                    <!-- Reddit -->
                    <a href="https://reddit.com/submit?url={{ urlencode(request()->fullUrl()) }}" target="_blank"
                        class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/color/48/reddit--v1.png" alt="Reddit" class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">Reddit</span>
                    </a>

                    <!-- VK -->
                    <a href="https://vk.com/share.php?url={{ urlencode(request()->fullUrl()) }}" target="_blank"
                        class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/color/48/vk-circled.png" alt="VK" class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">VK</span>
                    </a>

                    <!-- OK.ru -->
                    <a href="https://connect.ok.ru/offer?url={{ urlencode(request()->fullUrl()) }}" target="_blank"
                        class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/color/48/odnoklassniki.png" alt="OK" class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">OK</span>
                    </a>

                    <!-- Pinterest -->
                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(request()->fullUrl()) }}"
                        target="_blank" class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/color/48/pinterest--v1.png" alt="Pinterest" class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">Pinterest</span>
                    </a>

                    <!-- Blogger -->
                    <a href="https://www.blogger.com/blog-this.g?u={{ urlencode(request()->fullUrl()) }}" target="_blank"
                        class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/color/48/blogger.png" alt="Blogger" class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">Blogger</span>
                    </a>

                    <!-- Tumblr -->
                    <a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl={{ urlencode(request()->fullUrl()) }}"
                        target="_blank" class="flex flex-col items-center min-w-max">
                        <div class="bg-white p-3 rounded-full shadow-md hover:opacity-80 transition">
                            <img src="https://img.icons8.com/color/48/tumblr.png" alt="Tumblr" class="w-8 h-8">
                        </div>
                        <span class="text-white text-xs mt-2">Tumblr</span>
                    </a>

                </div>

                <!-- Tombol Slide Kanan -->
                <button id="slideRight"
                    class="absolute right-0 z-10 bg-[#333] hover:bg-[#444] text-white p-2 rounded-full shadow-md">
                    &#10095;
                </button>

            </div>

            <!-- Link & Copy -->
            <div class="flex items-center bg-[#121212] rounded-lg overflow-hidden border border-gray-600 mt-6">
                <input id="shareLink" type="text" value="{{ request()->fullUrl() }}"
                    class="flex-1 bg-transparent text-white px-3 py-2 text-sm focus:outline-none" readonly>
                <button id="copyLink" class="bg-[#9A0605] hover:bg-[#7a0504] text-white px-4 py-2 text-sm">Salin</button>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let liked = false;
            let disliked = false;
            let likeCount = {{ $news->reaksi->where('jenis_reaksi', 'Suka')->count() }};
            let dislikeCount = {{ $news->reaksi->where('jenis_reaksi', 'Tidak Suka')->count() }};
            const newsId = "{{ $news->id }}";
            const likeButton = document.getElementById('likeButton');
            const dislikeButton = document.getElementById('dislikeButton');
            const likeCountElement = document.getElementById('likeCount');
            const dislikeCountElement = document.getElementById('dislikeCount');

            likeButton.addEventListener('click', function () {
                if (!liked) {
                    likeCount++;
                    disliked = false;
                    dislikeCount = Math.max(dislikeCount - 1, 0); // Prevent negative dislike count
                    liked = true;
                } else {
                    likeCount--;
                    liked = false;
                }
                updateCounts();
                submitReaction('Suka');
            });

            dislikeButton.addEventListener('click', function () {
                if (!disliked) {
                    dislikeCount++;
                    liked = false;
                    likeCount = Math.max(likeCount - 1, 0); // Prevent negative like count
                    disliked = true;
                } else {
                    dislikeCount--;
                    disliked = false;
                }
                updateCounts();
                submitReaction('Tidak Suka');
            });

            function updateCounts() {
                likeCountElement.textContent = likeCount;
                dislikeCountElement.textContent = dislikeCount;
            }

            function submitReaction(jenisReaksi) {
                fetch("{{ route('reaksi.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        jenis_reaksi: jenisReaksi,
                        item_id: newsId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Reaction saved');
                    } else {
                        console.error('Error saving reaction');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });

        const shareModal = document.getElementById('shareModal');
        const openShareModal = document.getElementById('openShareModal');
        const closeShareModal = document.getElementById('closeShareModal');
        const copyLinkBtn = document.getElementById('copyLink');
        const shareLinkInput = document.getElementById('shareLink');

        const iconContainer = document.getElementById('iconContainer');
        const slideLeftBtn = document.getElementById('slideLeft');
        const slideRightBtn = document.getElementById('slideRight');

        // Buka modal
        openShareModal.addEventListener('click', () => {
            shareModal.classList.remove('hidden');
        });

        // Tutup modal
        closeShareModal.addEventListener('click', () => {
            shareModal.classList.add('hidden');
        });

        // Klik di luar modal untuk tutup
        shareModal.addEventListener('click', (e) => {
            if (e.target === shareModal) {
                shareModal.classList.add('hidden');
            }
        });

        // Salin link ke clipboard
        copyLinkBtn.addEventListener('click', () => {
            shareLinkInput.select();
            shareLinkInput.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(shareLinkInput.value)
                .then(() => {
                    copyLinkBtn.textContent = 'Disalin!';
                    setTimeout(() => {
                        copyLinkBtn.textContent = 'Salin';
                    }, 2000);
                })
                .catch(() => {
                    alert('Gagal menyalin link. Silakan salin manual.');
                });
        });

        // Tombol Slide
        slideLeftBtn.addEventListener('click', () => {
            iconContainer.scrollBy({
                left: -150,
                behavior: 'smooth'
            });
        });

        slideRightBtn.addEventListener('click', () => {
            iconContainer.scrollBy({
                left: 150,
                behavior: 'smooth'
            });
        });
    </script>
@endsection
