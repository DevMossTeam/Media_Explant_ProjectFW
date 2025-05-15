@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

                @php
                    use Illuminate\Support\Facades\Cookie;
                    use App\Models\User;

                    $userUid = Cookie::get('user_uid');
                    $user = $userUid ? User::where('uid', $userUid)->first() : null;
                    $isBookmarked = \App\Models\UserReact\Bookmark::where('user_id', $user->uid ?? null)
                        ->where('item_id', $news->id)
                        ->where('bookmark_type', 'Berita')
                        ->exists();
                @endphp

                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">{{ $news->judul }}</h1>
                <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                    <div>
                        Oleh: {{ $news->user->nama_lengkap ?? 'Tidak Diketahui' }} -
                        {{ \Carbon\Carbon::parse($news->tanggal_diterbitkan)->format('d F Y - H.i') }} WIB
                    </div>
                    <button id="bookmark-btn" class="flex items-center gap-2 text-gray-400 hover:text-gray-800"
                        data-item-id="{{ $news->id }}" data-bookmarked="{{ $isBookmarked ? 'true' : 'false' }}">
                        <span class="text-sm">
                            {{ $isBookmarked ? 'Batalkan Bookmark' : 'Simpan dan baca nanti' }}
                        </span>
                        <span id="bookmark-icon">
                            @if ($isBookmarked)
                                <i class="fa-solid fa-bookmark text-xl text-black"></i>
                            @else
                                <i class="fa-regular fa-bookmark text-xl text-gray-400"></i>
                            @endif
                        </span>
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
                        <button id="likeButton"
                            class="flex items-center gap-2 hover:text-gray-700 {{ $userReaksi && $userReaksi->jenis_reaksi === 'Suka' ? 'text-blue-600' : '' }}">
                            <i class="fas fa-thumbs-up"></i>
                            <span id="likeCount">{{ $likeCount ?? 0 }}</span>
                        </button>
                        <button id="dislikeButton"
                            class="flex items-center gap-2 hover:text-gray-700 {{ $userReaksi && $userReaksi->jenis_reaksi === 'Tidak Suka' ? 'text-blue-600' : '' }}">
                            <i class="fas fa-thumbs-down"></i>
                            <span id="dislikeCount">{{ $dislikeCount ?? 0 }}</span>
                        </button>

                        <div class="relative">
                            <button id="openShareModal" class="flex items-center gap-2 hover:text-gray-700">
                                <i class="fas fa-share-nodes"></i> Share
                            </button>
                        </div>

                        <button id="reportButton"
                            class="flex items-center gap-2 text-[#ABABAB] hover:text-[#9A0605] focus:text-[#9A0605]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v16M4 4h6l2 2h6v6h-6l-2-2H4z" />
                            </svg>
                            <span>Laporkan</span>
                        </button>
                    </div>
                </div>

                <!-- Komentar -->
                <div class="mt-10">
                    <form id="komentarForm" method="POST">
                        @csrf
                        <div class="relative w-full">
                            <input type="text" name="komentar" id="komentarInput" placeholder="Tulis komentarmu disini"
                                class="w-full border border-[#9A0605] rounded-full pr-12 pl-4 py-2 text-sm focus:outline-none" />
                            <button type="submit"
                                class="absolute right-0 top-0 bottom-0 w-10 flex items-center justify-center bg-[#9A0605] rounded-full rounded-l-none text-white hover:bg-red-800">
                                <i class="fas fa-paper-plane text-sm"></i>
                            </button>
                        </div>
                    </form>

                    <div class="mt-5 border border-gray-200 rounded-lg bg-gray-50 p-4">
                        <div id="komentarContainer"
                            class="space-y-4 text-sm text-gray-700 max-h-[300px] overflow-y-auto transition-all duration-300">
                            @forelse ($komentarList->where('parent_id', null) as $komentar)
                                <div class="komentar-item" data-id="{{ $komentar->id }}">
                                    <div>
                                        <span class="font-semibold">{{ $komentar->user->nama_pengguna }}</span> —
                                        <span class="isi-komentar">
                                            {{ \Illuminate\Support\Str::limit($komentar->isi_komentar, 150) }}
                                            @if (strlen($komentar->isi_komentar) > 150)
                                                <button class="text-xs text-blue-600 hover:underline show-full"
                                                    data-full="{{ $komentar->isi_komentar }}"
                                                    data-short="{{ \Illuminate\Support\Str::limit($komentar->isi_komentar, 150) }}">Lihat
                                                    selengkapnya</button>
                                            @endif
                                        </span>
                                    </div>
                                    <button class="text-xs text-blue-600 hover:underline reply-btn mt-1">Reply</button>

                                    <div class="replies ml-4 text-sm text-gray-500 mt-2 space-y-2 hidden">
                                        @foreach ($komentar->replies as $reply)
                                            <div>
                                                ↳ <span class="font-semibold">{{ $reply->user->nama_pengguna }}</span> —
                                                {{ $reply->isi_komentar }}
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($komentar->replies->count())
                                        <button class="toggle-replies text-xs text-blue-600 hover:underline mt-1">
                                            {{ $komentar->replies->count() === 1 ? 'Lihat 1 balasan' : 'Lihat semua ' . $komentar->replies->count() . ' balasan' }}
                                        </button>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center text-gray-500">Belum Ada Komentar</div>
                            @endforelse
                        </div>
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

    <!-- Modal Pelaporan -->
    <div id="reportModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-20 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
            <h2 class="text-lg font-bold mb-4">Laporkan Artikel</h2>
            <form id="reportForm">
                <div class="mb-4">
                    <label class="block mb-2">Pilih alasan pelaporan:</label>
                    <div id="reportReasons" class="space-y-4">
                        @php
                            $reasons = [
                                'Konten seksual',
                                'Konten kekerasan atau menjijikkan',
                                'Konten kebencian atau pelecehan',
                                'Tindakan berbahaya',
                                'Spam atau misinformasi',
                                'Masalah hukum',
                                'Teks bermasalah',
                            ];
                        @endphp
                        @foreach ($reasons as $reason)
                            <label class="block">
                                <input type="radio" name="reportReason" value="{{ $reason }}"
                                    class="form-radio">
                                <span class="ml-2">{{ $reason }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <button type="button" id="nextButton" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mt-4"
                    disabled>Berikutnya</button>
            </form>
        </div>
    </div>

    <!-- Modal Laporan Tambahan -->
    <div id="additionalReportModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-20 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
            <h2 class="text-lg font-bold mb-4">Laporan Tambahan Opsional</h2>
            <textarea class="w-full border border-gray-300 rounded p-2" placeholder="Berikan detail tambahan" maxlength="500"></textarea>
            <div class="text-right text-sm text-gray-500">0/500</div>
            <div class="mt-4 flex justify-end space-x-4">
                <button type="button" id="backButton"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Kembali</button>
                <button type="button" id="submitReportButton"
                    class="bg-blue-500 text-white px-4 py-2 rounded">Laporkan</button>
            </div>
        </div>
    </div>

    <!-- Modal Terima Kasih -->
    <div id="thankYouModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-30">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 h-24 w-24 text-green-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <p class="text-lg font-semibold mb-4">Terima kasih telah melaporkan artikel ini!</p>
            <p class="text-gray-600">Laporan Anda akan kami tinjau sesegera mungkin.</p>
            <button type="button" id="closeThankYouModal"
                class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Tutup</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reportButton = document.getElementById('reportButton');
            const reportModal = document.getElementById('reportModal');
            const nextButton = document.getElementById('nextButton');
            const additionalReportModal = document.getElementById('additionalReportModal');
            const thankYouModal = document.getElementById('thankYouModal');
            const closeThankYouModalButton = document.getElementById('closeThankYouModal');
            const backButton = document.getElementById('backButton');

            const reasonsWithOptions = {
                "Konten seksual": ["Pornografi", "Eksploitasi anak", "Pelecehan seksual"],
                "Konten kekerasan atau menjijikkan": ["Kekerasan fisik", "Kekerasan verbal",
                    "Kekerasan psikologis"
                ],
                "Konten kebencian atau pelecehan": ["Pelecehan rasial", "Pelecehan agama", "Pelecehan seksual"],
                "Tindakan berbahaya": ["Penggunaan narkoba", "Penyalahgunaan senjata",
                    "Tindakan berbahaya lainnya"
                ],
                "Spam atau misinformasi": ["Berita palsu", "Iklan tidak sah", "Penipuan"],
                "Masalah hukum": ["Pelanggaran hak cipta", "Pelanggaran privasi", "Masalah hukum lainnya"],
                "Teks bermasalah": ["Kata-kata kasar", "Teks diskriminatif", "Teks mengandung kekerasan"]
            };

            reportButton.addEventListener('click', () => reportModal.classList.remove('hidden'));

            document.querySelectorAll('input[name="reportReason"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const selectedReason = radio.value;
                    const label = radio.closest('label');
                    const prev = document.querySelector('.additional-container');
                    if (prev) prev.remove();

                    if (reasonsWithOptions[selectedReason]) {
                        const container = document.createElement('div');
                        container.classList.add('additional-container', 'mt-2');

                        const select = document.createElement('select');
                        select.classList.add('form-select', 'w-full', 'border', 'border-gray-300',
                            'rounded', 'p-2');
                        const defaultOption = document.createElement('option');
                        defaultOption.textContent = "Pilih masalah";
                        defaultOption.disabled = true;
                        defaultOption.selected = true;
                        select.appendChild(defaultOption);

                        reasonsWithOptions[selectedReason].forEach(option => {
                            const opt = document.createElement('option');
                            opt.value = option;
                            opt.textContent = option;
                            select.appendChild(opt);
                        });

                        container.appendChild(select);
                        label.appendChild(container);

                        select.addEventListener('change', () => {
                            if (select.value) {
                                nextButton.classList.remove('bg-gray-300');
                                nextButton.classList.add('bg-blue-500', 'text-white');
                                nextButton.disabled = false;
                            }
                        });
                    }

                    nextButton.classList.add('bg-gray-300');
                    nextButton.classList.remove('bg-blue-500', 'text-white');
                    nextButton.disabled = true;
                });
            });

            nextButton.addEventListener('click', function() {
                reportModal.classList.add('hidden');
                additionalReportModal.classList.remove('hidden');
            });

            backButton.addEventListener('click', function() {
                additionalReportModal.classList.add('hidden');
                reportModal.classList.remove('hidden');
            });

            closeThankYouModalButton.addEventListener('click', function() {
                thankYouModal.classList.add('hidden');
                resetForm();
            });

            function resetForm() {
                document.querySelectorAll('input[name="reportReason"]').forEach(radio => radio.checked = false);
                const container = document.querySelector('.additional-container');
                if (container) container.remove();
                nextButton.classList.add('bg-gray-300');
                nextButton.classList.remove('bg-blue-500', 'text-white');
                nextButton.disabled = true;
                document.querySelector('textarea').value = '';
            }

            function closeModalOnOutsideClick(modal) {
                window.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.classList.add('hidden');
                        if (modal === thankYouModal) resetForm();
                    }
                });
            }

            closeModalOnOutsideClick(reportModal);
            closeModalOnOutsideClick(thankYouModal);

            // Submit report
            document.getElementById('submitReportButton').addEventListener('click', function() {
                const selectedReason = document.querySelector('input[name="reportReason"]:checked');
                const additionalDetail = document.querySelector('textarea').value.trim();
                const itemId = new URLSearchParams(window.location.search).get('a');

                if (selectedReason) {
                    fetch('/report-news', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                report_reason: selectedReason.value,
                                detail_pesan: additionalDetail,
                                item_id: itemId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                additionalReportModal.classList.add('hidden');
                                thankYouModal.classList.remove('hidden');
                            } else {
                                alert(data.message || 'Gagal mengirim laporan.');
                            }
                        });
                } else {
                    alert('Silakan pilih alasan pelaporan.');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const komentarForm = document.getElementById('komentarForm');
            const komentarInput = document.getElementById('komentarInput');
            const komentarContainer = document.getElementById('komentarContainer');
            let currentReplyTarget = null;

            komentarForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                const komentar = komentarInput.value.trim();
                if (!komentar) return;

                const parentId = komentarInput.dataset.replyTo || null;

                try {
                    const response = await fetch("{{ route('komentar.kirim') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            komentar: komentar,
                            item_id: "{{ $news->id }}",
                            komentar_type: "Berita",
                            parent_id: parentId
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        const noCommentText = komentarContainer.querySelector(
                            '.text-center.text-gray-500');
                        if (noCommentText) noCommentText.remove();

                        const replyHTML =
                            `<div>↳ <span class="font-semibold">${data.nama_pengguna}</span> — ${data.isi_komentar}</div>`;

                        if (data.parent_id) {
                            const parent = document.querySelector(
                                `.komentar-item[data-id="${data.parent_id}"] .replies`);
                            parent.insertAdjacentHTML('beforeend', replyHTML);

                            // Tampilkan container balasan jika tersembunyi
                            if (parent.classList.contains('hidden')) {
                                parent.classList.remove('hidden');
                            }

                            const toggleButton = parent.closest('.komentar-item').querySelector(
                                '.toggle-replies');
                            if (toggleButton) {
                                const jumlah = parent.children.length;
                                toggleButton.textContent = 'Sembunyikan balasan';
                                toggleButton.classList.remove('hidden');
                            }

                        } else {
                            const div = document.createElement('div');
                            div.className = "komentar-item animate-fade-in";
                            div.setAttribute('data-id', data.id);
                            div.innerHTML = `
            <div>
                <span class="font-semibold">${data.nama_pengguna}</span> —
                <span class="isi-komentar">${data.isi_komentar}</span>
            </div>
            <button class="text-xs text-blue-600 hover:underline reply-btn mt-1">Reply</button>
            <div class="replies ml-4 text-sm text-gray-500 mt-2 space-y-2 hidden"></div>
            <button class="toggle-replies text-xs text-blue-600 hover:underline mt-1 hidden"></button>
        `;
                            komentarContainer.prepend(div);
                        }

                        komentarInput.value = '';
                        komentarInput.removeAttribute('data-reply-to');
                        komentarInput.placeholder = 'Tulis komentarmu disini';
                        if (currentReplyTarget) {
                            currentReplyTarget.remove();
                            currentReplyTarget = null;
                        }
                    } else {
                        alert("Gagal mengirim komentar.");
                    }
                } catch (err) {
                    alert("Gagal mengirim komentar.");
                    console.error(err);
                }
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('reply-btn')) {
                    if (currentReplyTarget) currentReplyTarget.remove();

                    const parentKomentar = e.target.closest('.komentar-item');
                    const parentId = parentKomentar.dataset.id;

                    const formReply = document.createElement('div');
                    formReply.className = 'mt-2';
                    formReply.innerHTML = `
                <div class="flex items-center gap-2">
                    <input type="text" class="reply-input border border-gray-300 rounded-full px-3 py-1 text-sm flex-1" placeholder="Balas komentar ini..." />
                    <button class="send-reply px-3 py-1 bg-[#9A0605] text-white rounded-full text-sm hover:bg-red-800">Kirim</button>
                </div>
            `;
                    parentKomentar.appendChild(formReply);
                    currentReplyTarget = formReply;

                    const input = formReply.querySelector('.reply-input');
                    input.focus();

                    const submitReply = async () => {
                        const isi = input.value.trim();
                        if (!isi) return;

                        try {
                            const response = await fetch("{{ route('komentar.kirim') }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                                credentials: 'same-origin',
                                body: JSON.stringify({
                                    komentar: isi,
                                    item_id: "{{ $news->id }}",
                                    komentar_type: "Berita",
                                    parent_id: parentId
                                })
                            });

                            const data = await response.json();

                            if (data.success) {
                                const parent = document.querySelector(
                                    `.komentar-item[data-id="${data.parent_id}"] .replies`);
                                const replyHTML =
                                    `<div>↳ <span class="font-semibold">${data.nama_pengguna}</span> — ${data.isi_komentar}</div>`;
                                parent.insertAdjacentHTML('beforeend', replyHTML);

                                // Tampilkan dan ubah tombol toggle
                                if (parent.classList.contains('hidden')) {
                                    parent.classList.remove('hidden');
                                }

                                const toggleButton = parent.closest('.komentar-item').querySelector(
                                    '.toggle-replies');
                                if (toggleButton) {
                                    const jumlah = parent.children.length;
                                    toggleButton.textContent = 'Sembunyikan balasan';
                                    toggleButton.classList.remove('hidden');
                                }

                                // Bersihkan reply form
                                currentReplyTarget.remove();
                                currentReplyTarget = null;
                            } else {
                                alert("Gagal mengirim komentar.");
                            }

                        } catch (err) {
                            console.error(err);
                            alert("Gagal mengirim komentar.");
                        }
                    };

                    formReply.querySelector('.send-reply').addEventListener('click', submitReply);
                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            submitReply();
                        }
                    });
                }

                if (e.target.classList.contains('show-full')) {
                    const fullText = e.target.dataset.full;
                    const shortText = e.target.dataset.short;
                    const span = e.target.parentElement;

                    span.innerHTML = `
        ${fullText}
        <button class="text-xs text-blue-600 hover:underline show-less"
            data-full="${fullText}" data-short="${shortText}">
            Lihat lebih sedikit
        </button>
    `;
                }

                if (e.target.classList.contains('show-less')) {
                    const shortText = e.target.dataset.short;
                    const fullText = e.target.dataset.full;
                    const span = e.target.parentElement;

                    span.innerHTML = `
        ${shortText}
        <button class="text-xs text-blue-600 hover:underline show-full"
            data-full="${fullText}" data-short="${shortText}">
            Lihat selengkapnya
        </button>
    `;
                }

                if (e.target.classList.contains('toggle-replies')) {
                    const container = e.target.previousElementSibling;
                    if (container.classList.contains('hidden')) {
                        container.classList.remove('hidden');
                        e.target.textContent = `Sembunyikan balasan`;
                    } else {
                        container.classList.add('hidden');
                        const jumlah = container.children.length;
                        e.target.textContent = jumlah === 1 ? `Lihat 1 balasan` :
                            `Lihat semua ${jumlah} balasan`;
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const bookmarkBtn = document.getElementById('bookmark-btn');
            const text = bookmarkBtn.querySelector('span');
            const iconContainer = document.getElementById('bookmark-icon');

            bookmarkBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const itemId = this.dataset.itemId;

                fetch('/bookmark/toggle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            item_id: itemId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'bookmarked') {
                            iconContainer.innerHTML =
                                '<i class="fa-solid fa-bookmark text-xl text-black"></i>';
                            text.textContent = 'Batalkan Bookmark';
                            bookmarkBtn.setAttribute('data-bookmarked', 'true');
                        } else {
                            iconContainer.innerHTML =
                                '<i class="fa-regular fa-bookmark text-xl text-gray-400"></i>';
                            text.textContent = 'Simpan dan baca nanti';
                            bookmarkBtn.setAttribute('data-bookmarked', 'false');
                        }
                    });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const likeButton = document.getElementById('likeButton');
            const dislikeButton = document.getElementById('dislikeButton');
            const likeCountSpan = document.getElementById('likeCount');
            const dislikeCountSpan = document.getElementById('dislikeCount');
            const newsId = document.querySelector('[data-news-id]').getAttribute('data-news-id');

            likeButton.addEventListener('click', function() {
                sendReaction('Suka');
            });

            dislikeButton.addEventListener('click', function() {
                sendReaction('Tidak Suka');
            });

            function sendReaction(jenisReaksi) {
                fetch('/reaksi', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        credentials: 'same-origin', // Pastikan cookie dikirim
                        body: JSON.stringify({
                            item_id: newsId,
                            jenis_reaksi: jenisReaksi,
                            reaksi_type: 'Berita'
                        })
                    })
                    .then(async response => {
                        const contentType = response.headers.get('Content-Type');

                        if (!response.ok) {
                            if (contentType && contentType.includes('application/json')) {
                                const data = await response.json();
                                throw new Error(data.message || 'Gagal memproses reaksi.');
                            } else {
                                throw new Error('Terjadi kesalahan pada server (bukan respons JSON).');
                            }
                        }

                        return response.json();
                    })
                    .then(data => {
                        likeCountSpan.textContent = data.likeCount;
                        dislikeCountSpan.textContent = data.dislikeCount;

                        if (jenisReaksi === 'Suka') {
                            likeButton.classList.add('text-blue-600');
                            dislikeButton.classList.remove('text-blue-600');
                        } else {
                            dislikeButton.classList.add('text-blue-600');
                            likeButton.classList.remove('text-blue-600');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error.message);
                        alert(error.message); // Bisa dihapus kalau tidak ingin tampilkan alert
                    });
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
