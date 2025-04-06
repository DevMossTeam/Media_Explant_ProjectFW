<div id="rekomendasi-container" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
    @foreach ($rekomendasiBuletin as $item)
        <div class="flex flex-col">
            <iframe src="{{ route('buletin.pdfPreview', ['id' => $item->id]) }}#page=1"
                    class="w-full h-40 rounded shadow border" type="application/pdf"></iframe>

            <div class="mt-2 text-xs font-semibold">
                <span class="text-[#990505]">BULETIN | </span>
                <span class="text-[#A8A8A8]">{{ \Carbon\Carbon::parse($item->release_date)->translatedFormat('d M Y') }}</span>
            </div>

            <div class="text-sm font-semibold leading-snug">{{ $item->judul }}</div>

            <a href="{{ url('/produk/buletin/browse?f=' . $item->id) }}"
               class="mt-1 inline-block text-blue-600 hover:underline text-sm">
                Lihat Buletin
            </a>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="mt-4" id="rekomendasi-pagination" data-url="{{ request()->url() }}">
    {{ $rekomendasiBuletin->withQueryString()->links() }}
</div>
