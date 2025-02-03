<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HomeArticle extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'konten_artikel',
        'tanggal_diterbitkan',
        'kategori',
        'visibilitas',
        'gambar'
    ];

    // Mengambil gambar pertama dari konten_artikel atau menggunakan gambar utama
    public function getFirstImageAttribute()
    {
        if (preg_match('/<img[^>]+src="([^">]+)"/i', $this->konten_artikel, $matches)) {
            return $matches[1]; // Mengembalikan URL gambar pertama
        }
        return $this->gambar ?? 'https://via.placeholder.com/400x200'; // Placeholder jika tidak ada gambar
    }

    // Mengambil deskripsi singkat dari konten_artikel (150 karakter pertama)
    public function getExcerptAttribute()
    {
        // Menghapus tag HTML dari konten_artikel
        $plainText = strip_tags($this->konten_artikel);

        // Ambil hanya 150 karakter pertama tanpa memotong kata
        return Str::words($plainText, 25); // 25 kata pertama dari konten
    }
}
