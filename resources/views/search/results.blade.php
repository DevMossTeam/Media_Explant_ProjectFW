@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-semibold mb-2">Hasil pencarian untuk: "{{ $keyword }}"</h2>
    <p class="text-gray-600 mb-4">{{ $total }} data ditemukan</p>

    @if($total === 0)
        <p class="text-gray-500">Tidak ditemukan hasil yang cocok.</p>
    @else
        <div class="space-y-6">

            @if($produk->count())
                <div>
                    <h3 class="text-lg font-semibold">Produk ({{ $produk->count() }})</h3>
                    <ul class="list-disc pl-5">
                        @foreach($produk as $item)
                            <li>{{ $item->judul }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($berita->count())
                <div>
                    <h3 class="text-lg font-semibold">Berita ({{ $berita->count() }})</h3>
                    <ul class="list-disc pl-5">
                        @foreach($berita as $item)
                            <li>{{ $item->judul }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($karya->count())
                <div>
                    <h3 class="text-lg font-semibold">Karya ({{ $karya->count() }})</h3>
                    <ul class="list-disc pl-5">
                        @foreach($karya as $item)
                            <li>{{ $item->judul }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    @endif
</div>
@endsection
