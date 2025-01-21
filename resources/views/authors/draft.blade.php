@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <div class="relative w-full md:w-2/3">
            <input type="text" id="searchInput" class="pl-10 pr-4 py-2 border rounded-lg w-full" placeholder="Cari artikel...">
            <div id="filterMenu" class="hidden absolute bg-white shadow-md rounded mt-2 w-48 z-10">
                <a href="{{ route('author.draft.index', ['sort' => 'oldest']) }}" class="block px-4 py-2">Terlama</a>
                <a href="{{ route('author.draft.index', ['sort' => 'newest']) }}" class="block px-4 py-2">Terbaru</a>
                <a href="{{ route('author.draft.index', ['visibility' => 'public']) }}" class="block px-4 py-2">Public</a>
                <a href="{{ route('author.draft.index', ['visibility' => 'private']) }}" class="block px-4 py-2">Private</a>
            </div>
        </div>
    </div>

    <div id="publicationContainer">
        @if(isset($articles) && $articles->count() > 0)
            @foreach($articles as $article)
                <div class="flex items-start mb-4">
                    <!-- Gambar Artikel -->
                    <div class="w-40 h-20 mr-4">
                        @php
                            $firstImage = '';
                            if (preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $article->konten_artikel, $image)) {
                                $firstImage = $image['src'];
                            }
                        @endphp
                        @if($firstImage)
                            <img src="{{ $firstImage }}" class="object-cover rounded-lg w-full h-full" alt="Gambar artikel">
                        @else
                            <div class="bg-gray-200 w-full h-full flex items-center justify-center rounded-lg">
                                <span class="text-gray-500 text-sm">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>

                    <!-- Detail Artikel -->
                    <div class="flex-1">
                        <h3 class="font-bold text-lg">{{ $article->judul }}</h3>
                        <p class="text-sm text-gray-500">Dipublish {{ $article->time_ago }}</p>
                        <p class="text-xs bg-gray-200 px-2 py-0.5 rounded inline-block">
                            {{ ucfirst($article->visibilitas) }}
                        </p>
                    </div>

                    <!-- Aksi -->
                    <div class="ml-4">
                        <a href="{{ route('author.draft.edit', $article->id) }}" class="text-blue-500 mr-2">Edit</a>
                        <form action="{{ route('author.draft.destroy', $article->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-500 text-center">Tidak ada artikel yang tersedia.</p>
        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        @if(isset($articles) && $articles instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $articles->links() }}
        @endif
    </div>
</div>
@endsection
