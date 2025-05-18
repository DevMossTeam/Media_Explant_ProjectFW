@extends('layouts.app')

@section('content')
    <div class="max-w-[1320px] mx-auto px-4 sm:px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Karya Kami --}}
            <div class="md:col-span-2">
                <h2 class="text-2xl font-bold mb-0">Karya Kami</h2>
                <p class="text-sm text-[#A8A8A8] mb-1">Kumpulan Karya Karya Terbaik</p>
                <div class="w-full h-[2px] bg-[#A8A8A8] mb-4"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($karya as $item)
                        <div class="flex gap-4">
                            <a href="{{ route('karya.fotografi.read', ['k' => $item->id]) }}"
                                class="block w-[200px] h-[160px] overflow-hidden rounded-md flex-shrink-0">
                                <img src="data:image/jpeg;base64,{{ $item->media }}" alt="{{ $item->judul }}"
                                    class="w-full h-full object-cover" />
                            </a>
                            <div class="flex flex-col justify-between w-full">
                                <div class="space-y-[2px]">
                                    <p class="text-sm mb-1">
                                        <span class="text-[#990505] font-bold">
                                            {{ strtoupper(str_replace('_', ' ', $item->kategori)) }} |
                                        </span>
                                        <span class="text-[#A8A8A8]">
                                            {{ \Carbon\Carbon::parse($item->release_date)->format('d M Y') }}
                                        </span>
                                    </p>
                                    <a href="{{ route('karya.fotografi.read', ['k' => $item->id]) }}">
                                        <h3 class="text-base font-bold">{{ $item->judul }}</h3>
                                    </a>
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-[#ABABAB] m-0">{{ $item->user->nama_lengkap ?? '-' }}</p>
                                        <div class="flex items-center gap-4 text-[#ABABAB] text-sm">
                                            <div class="flex items-center gap-1">
                                                <i
                                                    class="fa-regular fa-thumbs-up"></i><span>{{ $item->like_count ?? 0 }}</span>
                                            </div>
                                            <button type="button" class="flex items-center gap-1 openShareModal"
                                                data-url="{{ route('karya.fotografi.read', ['k' => $item->id]) }}">
                                                <i class="fa-solid fa-share-nodes"></i>
                                                <span>Share</span>
                                            </button>
                                        </div>
                                    </div>
                                    <a href="{{ route('karya.fotografi.read', ['k' => $item->id]) }}"
                                        class="text-sm text-[#5773FF]">Lihat Gambar</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Terbaru dan Rekomendasi Hari Ini --}}
            <div class="md:col-span-1">

                {{-- Terbaru --}}
                <div class="flex flex-col mb-8">
                    <div class="flex items-center">
                        <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                        <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]"
                            style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                            Terbaru
                        </h2>
                    </div>
                    <div class="w-full h-[2px] bg-gray-300"></div>

                    <div class="flex flex-col gap-3 mt-4">
                        @foreach ($terbaru as $item)
                            <a href="{{ route('karya.fotografi.read', ['k' => $item->id]) }}"
                                class="relative w-full h-[170px] overflow-hidden rounded-lg shadow-md block">
                                <img src="data:image/jpeg;base64,{{ $item->media }}" alt="{{ $item->judul }}"
                                    class="w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-[#990505] to-transparent opacity-90">
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 right-0 px-3 py-1 text-white text-[13px] font-semibold z-10">
                                    {{ $item->judul }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Rekomendasi Hari Ini --}}
                <div class="mt-4">
                    <div class="flex items-center">
                        <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                        <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]"
                            style="clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%)">
                            Rekomendasi Hari Ini
                        </h2>
                    </div>
                    <div class="w-full h-[2px] bg-gray-300"></div>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        @foreach ($rekomendasi as $item)
                            <div class="flex flex-col items-start gap-1">
                                <a href="{{ route('karya.fotografi.read', ['k' => $item->id]) }}"
                                    class="block w-full overflow-hidden rounded-md shadow-md aspect-[4/3]">
                                    <img src="data:image/jpeg;base64,{{ $item->media }}" alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover" />
                                </a>
                                <a href="{{ route('karya.fotografi.read', ['k' => $item->id]) }}">
                                    <h3 class="text-sm font-bold">{{ $item->judul }}</h3>
                                </a>
                                <div class="flex items-center justify-between w-full text-[#ABABAB] text-xs">
                                    <p>{{ $item->user->nama_lengkap ?? '-' }}</p>
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center gap-1">
                                            <i
                                                class="fa-regular fa-thumbs-up"></i><span>{{ $item->like_count ?? 0 }}</span>
                                        </div>
                                        <button type="button" class="flex items-center gap-1 openShareModal"
                                            data-url="{{ route('karya.fotografi.read', ['k' => $item->id]) }}">
                                            <i class="fa-solid fa-share-nodes"></i>
                                            <span>Share</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('karya.components.share-modal')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareModal = document.getElementById('shareModal');
            const closeShareModal = document.getElementById('closeShareModal');
            const copyLinkBtn = document.getElementById('copyLink');
            const shareLinkInput = document.getElementById('shareLink');
            const iconContainer = document.getElementById('iconContainer');
            const slideLeftBtn = document.getElementById('slideLeft');
            const slideRightBtn = document.getElementById('slideRight');

            document.querySelectorAll('.openShareModal').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const url = button.dataset.url;
                    shareLinkInput.value = url;

                    iconContainer.querySelectorAll('a').forEach(link => {
                        const baseHref = link.dataset.base;
                        if (baseHref) {
                            link.href = baseHref + encodeURIComponent(url);
                        }
                    });

                    shareModal.classList.remove('hidden');
                });
            });

            closeShareModal.addEventListener('click', () => {
                shareModal.classList.add('hidden');
            });

            shareModal.addEventListener('click', (e) => {
                if (e.target === shareModal) {
                    shareModal.classList.add('hidden');
                }
            });

            copyLinkBtn.addEventListener('click', () => {
                shareLinkInput.select();
                document.execCommand('copy');
                copyLinkBtn.textContent = 'Disalin!';
                setTimeout(() => {
                    copyLinkBtn.textContent = 'Salin';
                }, 2000);
            });

            slideLeftBtn?.addEventListener('click', () => {
                iconContainer.scrollBy({
                    left: -150,
                    behavior: 'smooth'
                });
            });

            slideRightBtn?.addEventListener('click', () => {
                iconContainer.scrollBy({
                    left: 150,
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endpush
