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
}
