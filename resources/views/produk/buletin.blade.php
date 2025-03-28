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
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $buletin->judul }}</h5>
                            <p class="card-text">{{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('d M Y') }}</p>

                            <!-- Menampilkan halaman pertama PDF sebagai thumbnail dengan ukuran lebih kecil -->
                            <canvas id="pdf-viewer-{{ $buletin->id }}" width="200" height="260" style="border: 1px solid #ddd;"></canvas>

                            <a href="{{ route('buletin.show', $buletin->id) }}" class="btn btn-primary mt-2">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var url = "{{ route('pdf.preview', ['id' => $buletin->id]) }}";

                        fetch(url).then(response => response.blob()).then(blob => {
                            var reader = new FileReader();
                            reader.readAsArrayBuffer(blob);
                            reader.onloadend = function(event) {
                                var loadingTask = pdfjsLib.getDocument({data: event.target.result});
                                loadingTask.promise.then(function(pdf) {
                                    pdf.getPage(1).then(function(page) {
                                        var canvas = document.getElementById('pdf-viewer-{{ $buletin->id }}');
                                        var context = canvas.getContext('2d');

                                        // Menyesuaikan ukuran tetap
                                        var scale = 0.5;  // Ukuran lebih kecil
                                        var viewport = page.getViewport({ scale: scale });

                                        var fixedWidth = 200; // Ukuran tetap untuk semua thumbnail
                                        var fixedHeight = (viewport.height / viewport.width) * fixedWidth;

                                        canvas.width = fixedWidth;
                                        canvas.height = fixedHeight;

                                        var renderContext = {
                                            canvasContext: context,
                                            viewport: viewport
                                        };
                                        page.render(renderContext);
                                    });
                                });
                            };
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
@endsection
