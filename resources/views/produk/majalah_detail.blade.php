@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Judul dan informasi -->
    <h1>{{ $majalah->judul }}</h1>
    <p>Oleh: <strong>{{ $majalah->user ? $majalah->user->nama_lengkap : 'Tidak Diketahui' }}</strong></p>
    <p>{{ \Carbon\Carbon::parse($majalah->release_date)->translatedFormat('d M Y') }}</p>

    <!-- Tombol Unduh dan Pratinjau -->
    <div class="d-flex gap-3 mb-4">
        <a href="{{ route('majalah.pdfPreview', ['id' => $majalah->id]) }}" class="btn btn-primary">
            <i class="fas fa-download"></i> Unduh Sekarang
        </a>
        <button id="toggle-preview" class="btn btn-dark">
            <i class="fas fa-eye"></i> Pratinjau
        </button>
    </div>

    <!-- Tempat untuk Pratinjau DearFlip -->
    <div id="preview-container" class="d-none">
        <div id="dearflip-wrapper" style="width:100%;height:500px;"></div>
    </div>

    <a href="{{ route('majalah.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>

<!-- Include DearFlip CSS -->
<link rel="stylesheet" href="{{ asset('dflip/css/dflip.min.css') }}">

<!-- Include DearFlip JS -->
<script src="{{ asset('dflip/js/libs/jquery.min.js') }}"></script>
<script src="{{ asset('dflip/js/dflip.min.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var previewButton = document.getElementById("toggle-preview");
        var previewContainer = document.getElementById("preview-container");
        var dearflipWrapper = document.getElementById("dearflip-wrapper");
        var dearFlipInitialized = false; // Supaya tidak memuat ulang DearFlip setiap klik

        previewButton.addEventListener("click", function() {
            previewContainer.classList.toggle("d-none");

            if (!dearFlipInitialized) {
                dearflipWrapper.innerHTML = `
                    <div class="_df_custom" source="{{ route('pdf.preview', ['id' => $majalah->id]) }}" style="width:100%;height:500px;"></div>
                `;
                dearFlipInitialized = true;

                setTimeout(function () {
                    new DFLIP.Book({
                        source: "{{ route('pdf.preview', ['id' => $majalah->id]) }}",
                        container: document.querySelector("._df_custom"),
                    });
                }, 500);
            }
        });
    });
</script>

@endsection
