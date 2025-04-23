@extends('layouts.setting-layout')

@section('title', 'Pusat Bantuan')

@section('setting-content')
    <div class="p-6 max-w-xl">
        <h2 class="text-sm font-semibold text-red-700 italic mb-4">Pusat Bantuan Media Explant</h2>

        <!-- Form -->
        <form action="#" method="POST">
            @csrf
            <textarea name="pesan" rows="4"
                class="w-full p-4 bg-gray-100 text-sm text-gray-700 rounded-lg mb-4 resize-none border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-600"
                placeholder="Jelaskan permasalahan anda"></textarea>

            <button type="submit"
                class="w-full bg-red-600 text-white text-sm font-semibold py-2 rounded-lg hover:bg-red-700 transition">
                Kirim
            </button>
        </form>

        <!-- Info Kontak -->
        <p class="text-xs text-gray-400 mt-4 text-center leading-relaxed">
            Kami akan merespon anda melalui email atau anda dapat menghubungi kami dengan mengirimkan pesan
            melalui email resmi kami <span class="text-gray-500">ukpmexplant@journalist.com</span>
        </p>
    </div>
@endsection
