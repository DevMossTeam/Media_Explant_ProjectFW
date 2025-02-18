<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat array data untuk masing-masing kategori
        $berita = [
            [
                'id'                  => Str::random(12),
                'judul'               => 'Berita Siaran Pers',
                'tanggal_diterbitkan' => now(),
                'view_count'          => 0, // Set 0 agar tidak null
                'user_id'             => '4wU9InJ2aO8s8yH3IIYyZWEiBbML',
                'kategori'            => 'Siaran Pers',
                'konten_berita'       => 'Ini adalah berita tentang Siaran Pers.',
                'visibilitas'         => 'public',
            ],
            [
                'id'                  => Str::random(12),
                'judul'               => 'Berita Riset',
                'tanggal_diterbitkan' => now(),
                'view_count'          => 0,
                'user_id'             => '4wU9InJ2aO8s8yH3IIYyZWEiBbML',
                'kategori'            => 'Riset',
                'konten_berita'       => 'Ini adalah berita tentang Riset terbaru.',
                'visibilitas'         => 'public',
            ],
            [
                'id'                  => Str::random(12),
                'judul'               => 'Berita Wawancara',
                'tanggal_diterbitkan' => now(),
                'view_count'          => 0,
                'user_id'             => '4wU9InJ2aO8s8yH3IIYyZWEiBbML',
                'kategori'            => 'Wawancara',
                'konten_berita'       => 'Ini adalah berita hasil Wawancara dengan narasumber.',
                'visibilitas'         => 'public',
            ],
            [
                'id'                  => Str::random(12),
                'judul'               => 'Berita Diskusi',
                'tanggal_diterbitkan' => now(),
                'view_count'          => 0,
                'user_id'             => '4wU9InJ2aO8s8yH3IIYyZWEiBbML',
                'kategori'            => 'Diskusi',
                'konten_berita'       => 'Ini adalah berita tentang Diskusi publik.',
                'visibilitas'         => 'public',
            ],
            [
                'id'                  => Str::random(12),
                'judul'               => 'Berita Agenda',
                'tanggal_diterbitkan' => now(),
                'view_count'          => 0,
                'user_id'             => '4wU9InJ2aO8s8yH3IIYyZWEiBbML',
                'kategori'            => 'Agenda',
                'konten_berita'       => 'Ini adalah berita tentang Agenda mendatang.',
                'visibilitas'         => 'public',
            ],
            [
                'id'                  => Str::random(12),
                'judul'               => 'Berita Opini',
                'tanggal_diterbitkan' => now(),
                'view_count'          => 0,
                'user_id'             => '4wU9InJ2aO8s8yH3IIYyZWEiBbML',
                'kategori'            => 'Opini',
                'konten_berita'       => 'Ini adalah berita tentang Opini penulis.',
                'visibilitas'         => 'public',
            ],
        ];

        // Insert ke tabel berita
        DB::table('berita')->insert($berita);
    }
}
