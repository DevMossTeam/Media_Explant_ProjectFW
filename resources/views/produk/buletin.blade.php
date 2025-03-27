@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Produk Kami</h1>
    <p>Kumpulan Produk Terbaik</p>
    <hr>

    @if ($buletins->isNotEmpty())
        <div class="row">
            @foreach ($buletins as $buletin)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $buletin->judul }}</h5>
                            <p class="card-text">{{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('d M Y') }}</p>

                            <!-- Menampilkan halaman pertama PDF sebagai thumbnail -->
                            <canvas id="pdf-viewer-{{ $buletin->id }}" width="100%"></canvas>

                            <a href="{{ route('buletin.show', $buletin->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var url = "{{ route('pdf.preview', ['id' => $buletin->id]) }}";

                        var loadingTask = pdfjsLib.getDocument(url);
                        loadingTask.promise.then(function(pdf) {
                            pdf.getPage(1).then(function(page) {
                                var scale = 1.5;
                                var viewport = page.getViewport({ scale: scale });

                                var canvas = document.getElementById('pdf-viewer-{{ $buletin->id }}');
                                var context = canvas.getContext('2d');
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;

                                var renderContext = {
                                    canvasContext: context,
                                    viewport: viewport
                                };
                                page.render(renderContext);
                            });
                        });
                    });
                </script>
            @endforeach
        </div>
    @else
        <p>Buletin tidak ditemukan.</p>
    @endif
</div>

<!-- Tambahkan PDF.js -->
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
@endsection
