<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class HomeNews extends Model
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

    public function getFirstImageAttribute()
    {
        if (preg_match('/<img[^>]+src="([^">]+)"/i', $this->konten_berita, $matches)) {
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
     * Ambil ringkasan berita (150 karakter pertama tanpa memotong kata dan menghilangkan entitas HTML seperti &nbsp;)
     */
    public function getExcerptAttribute()
    {
        // Hilangkan entitas HTML seperti &nbsp;
        $cleanedContent = preg_replace('/&nbsp;/i', ' ', strip_tags($this->konten_berita));
        return Str::limit($cleanedContent, 150);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
}
