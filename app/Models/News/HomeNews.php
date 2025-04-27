<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class HomeNews extends Berita
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
    ];

    /**
     * Ambil 1 berita terbaru dari setiap kategori yang visibilitasnya public
     */
    public function getBeritaTeratasHariIni()
    {
        $news = HomeNews::where('visibilitas', 'public')
            ->orderBy('kategori')
            ->orderBy('tanggal_diterbitkan', 'desc')
            ->get()
            ->groupBy('kategori')
            ->map->first();

        return $news->values()->take(11);
    }

    /**
     * Ambil gambar pertama dari konten berita atau gunakan fallback
     */
    public function getFirstImageAttribute(): string
    {
        if (preg_match('/<img[^>]+src="([^">]+)"/i', $this->konten_berita, $matches)) {
            return $matches[1];
        }

        return $this->gambar ?? 'https://via.placeholder.com/400x200';
    }

    /**
     * Slug kategori untuk URL
     */
    public function getCategorySlugAttribute()
    {
        $mapping = [
            'Kampus' => 'kampus',
            'Kesehatan' => 'kesehatan',
            'KesenianHiburan' => 'kesenian-hiburan',
            'LiputanKhusus' => 'liputan-khusus',
            'NasionalInternasional' => 'nasional-internasional',
            'Olahraga' => 'olahraga',
            'OpiniEsai' => 'opini-esai',
            'Teknologi' => 'teknologi',
        ];

        return $mapping[$this->kategori] ?? Str::slug($this->kategori);
    }

    /**
     * URL artikel lengkap
     */
    public function getArticleUrlAttribute()
    {
        return url("/kategori/{$this->category_slug}/read?a={$this->id}");
    }

    /**
     * Ringkasan konten berita (150 karakter)
     */
    public function getExcerptAttribute()
    {
        $cleanedContent = preg_replace('/&nbsp;/i', ' ', strip_tags($this->konten_berita));
        return Str::limit($cleanedContent, 150);
    }

    /**
     * Relasi ke penulis berita
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
}
