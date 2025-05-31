@extends('layouts.app')

@section('content')
    <div class="max-w-[1320px] mx-auto px-4 sm:px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Terbaru --}}
            <div class="md:col-span-1">
                <div class="flex flex-col mb-8">
                    <div class="flex items-center">
                        <div class="w-[8px] h-[36px] bg-[#9A0605] mr-[4px]"></div>
                        <h2 class="text-lg font-semibold text-white px-8 py-1 bg-[#9A0605]"
                            style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%)">
                            Terbaru
                        </h2>
                    </div>
                    <div class="w-full h-[2px] bg-gray-300 mb-4"></div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @foreach ($terbaru as $item)
                        <div class="flex flex-col items-start">
                            <a href="{{ route('karya.puisi.read', ['k' => $item->id]) }}">
                                <img src="data:image/jpeg;base64,{{ $item->media }}" alt="{{ $item->judul }}"
                                    class="w-[280px] h-[240px] object-cover rounded-lg shadow-md" />
                            </a>
                            <p class="mt-2 text-sm text-left">
                                <span class="text-[#990505] font-bold">
                                    {{ strtoupper(str_replace('_', ' ', $item->kategori)) }} |
                                </span>
                                <span class="text-[#A8A8A8]">
                                    {{ \Carbon\Carbon::parse($item->release_date)->format('d M Y') }}
                                </span>
                            </p>
                            <a href="{{ route('karya.puisi.read', ['k' => $item->id]) }}">
                                <h3 class="text-base font-bold mb-1">{{ $item->judul }}</h3>
                            </a>
                            <p class="text-sm text-left">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 50) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Karya Kami --}}
            <div class="md:col-span-2 -mt-2">
                <h2 class="text-2xl font-bold mb-1">Karya Kami</h2>
                <p class="text-sm text-gray-500 mb-2">Kumpulan Karya Karya Terbaik</p>
                <div class="w-full h-[2px] bg-[#A8A8A8] mb-4"></div>

                <div class="grid grid-cols-2 gap-4">
                    @foreach ($karya as $item)
                        <div class="flex gap-4">
                            <a href="{{ route('karya.puisi.read', ['k' => $item->id]) }}">
                                <img src="data:image/jpeg;base64,{{ $item->media }}" alt="{{ $item->judul }}"
                                    class="w-[320px] h-[200px] object-cover rounded-lg shadow-md" />
                            </a>
                            <div class="flex flex-col justify-between text-left w-full">
                                <div>
                                    <p class="text-sm mb-1">
                                        <span class="text-[#990505] font-bold">
                                            {{ strtoupper(str_replace('_', ' ', $item->kategori)) }} |
                                        </span>
                                        <span class="text-[#A8A8A8]">
                                            {{ \Carbon\Carbon::parse($item->release_date)->format('d M Y') }}
                                        </span>
                                    </p>
                                    <a href="{{ route('karya.puisi.read', ['k' => $item->id]) }}">
                                        <h3 class="text-base font-bold mb-1">{{ $item->judul }}</h3>
                                    </a>
                                    <p class="text-sm text-gray-700 mb-2">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 80) }}
                                    </p>
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-[#ABABAB] font-semibold">
                                            {{ $item->user->nama_lengkap ?? '-' }}
                                        </p>
                                        <div class="flex gap-3 text-[#ABABAB] text-xs">
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-thumbs-up"></i>
                                                <span>{{ $item->like_count ?? 0 }}</span>
                                            </div>
                                            {{-- Tombol Share --}}
                                            <button type="button" class="flex items-center gap-1 openShareModal"
                                                data-url="{{ route('karya.puisi.read', ['k' => $item->id]) }}">
                                                <i class="fa-solid fa-share-nodes"></i>
                                                <span>Share</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
