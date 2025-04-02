@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $majalah->judul }}</h1>
    <p>{{ \Carbon\Carbon::parse($majalah->release_date)->translatedFormat('d M Y') }}</p>

    <!-- Elemen Flipbook -->
    <div class="_df_custom" source="{{ route('majalah.pdf.preview', ['id' => $majalah->id]) }}" style="width:100%;height:500px;"></div>

    <a href="{{ route('majalah.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>

<!-- Include DearFlip CSS -->
<link rel="stylesheet" href="{{ asset('dflip/css/dflip.min.css') }}">

<!-- Include DearFlip JS -->
<script src="{{ asset('dflip/js/libs/jquery.min.js') }}"></script>
<script src="{{ asset('dflip/js/dflip.min.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new DFLIP.Book({
            source: "{{ route('majalah.pdf.preview', ['id' => $majalah->id]) }}",
            container: document.querySelector("._df_custom"),
        });
    });
</script>

@endsection
