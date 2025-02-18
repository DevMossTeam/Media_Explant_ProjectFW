<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'id'        => Str::random(12),
                'nama_tag'  => 'Tag Pertama',
                'berita_id' => '1kQJ8CxVelKU',
                'produk_id' => null,
                'karya_id'  => null,
            ],
            [
                'id'        => Str::random(12),
                'nama_tag'  => 'Tag Kedua',
                'berita_id' => '1kQJ8CxVelKU',
                'produk_id' => null,
                'karya_id'  => null,
            ],
            [
                'id'        => Str::random(12),
                'nama_tag'  => 'Tag Ketiga',
                'berita_id' => '1kQJ8CxVelKU',
                'produk_id' => null,
                'karya_id'  => null,
            ],
            [
                'id'        => Str::random(12),
                'nama_tag'  => 'Tag Keempat',
                'berita_id' => '1kQJ8CxVelKU',
                'produk_id' => null,
                'karya_id'  => null,
            ],
            [
                'id'        => Str::random(12),
                'nama_tag'  => 'Tag Kelima',
                'berita_id' => '1kQJ8CxVelKU',
                'produk_id' => null,
                'karya_id'  => null,
            ],
        ];

        DB::table('tag')->insert($tags);
    }
}
