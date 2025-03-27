@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $buletin->judul }}</h1>
    <p>{{ \Carbon\Carbon::parse($buletin->release_date)->translatedFormat('d M Y') }}</p>

    <iframe src="{{ route('pdf.preview', ['id' => $buletin->id]) }}" width="100%" height="500px"></iframe>

    <a href="{{ route('buletin.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
