<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpiniArticle extends Model
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

    // Method untuk mengambil gambar pertama dari konten_artikel
    public function getFirstImageAttribute()
    {
        if (preg_match('/<img[^>]+src="([^">]+)"/i', $this->konten_artikel, $matches)) {
            return $matches[1]; // Mengembalikan URL gambar pertama
        }
        return 'https://via.placeholder.com/400x200'; // Placeholder jika tidak ada gambar
    }
}
