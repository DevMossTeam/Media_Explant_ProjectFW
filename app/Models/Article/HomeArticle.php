<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HomeArticle extends Model
{
    use HasFactory;

    protected $table = 'artikel';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'judul',
        'konten_artikel',
        'tanggal_diterbitkan',
        'kategori',
        'visibilitas',
        'gambar'
    ];

    public function getFirstImageAttribute()
    {
        if (preg_match('/<img[^>]+src="([^">]+)"/i', $this->konten_artikel, $matches)) {
            return $matches[1];
        }
        return $this->gambar ?? 'https://via.placeholder.com/400x200';
    }

    public function getCategorySlugAttribute()
    {
        $mapping = [
            'Siaran Pers' => 'siaran-pers',
            'Riset' => 'riset',
            'Wawancara' => 'wawancara',
            'Diskusi' => 'diskusi',
            'Agenda' => 'agenda',
            'Sastra' => 'sastra',
            'Opini' => 'opini'
        ];

        return $mapping[$this->kategori] ?? 'lainnya';
    }

    public function getArticleUrlAttribute()
    {
        return url("/kategori/{$this->category_slug}/read?a={$this->id}");
    }

    /**
     * Ambil ringkasan artikel (150 karakter pertama tanpa memotong kata dan menghilangkan entitas HTML seperti &nbsp;)
     */
    public function getExcerptAttribute()
    {
        // Hilangkan entitas HTML seperti &nbsp;
        $cleanedContent = preg_replace('/&nbsp;/i', ' ', strip_tags($this->konten_artikel));
        return Str::limit($cleanedContent, 150);
    }
}
