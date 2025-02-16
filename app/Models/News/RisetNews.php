<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RisetNews extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'judul',
        'konten_berita',
        'tanggal_diterbitkan',
        'kategori',
        'visibilitas',
        'gambar'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->id = (string) Str::uuid();
        });
    }

    public function getFirstImageAttribute(): string
    {
        if (preg_match('/<img[^>]+src="([^">]+)"/i', $this->konten_berita, $matches)) {
            return $matches[1];
        }
        return 'https://via.placeholder.com/400x200';
    }
}
