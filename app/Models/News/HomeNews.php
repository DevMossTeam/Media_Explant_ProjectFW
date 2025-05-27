<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

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

    public static function getBeritaTeratasHariIni()
    {
        $todayJakarta = Carbon::now('Asia/Jakarta')->toDateString();

        $categories = [
            'Kampus',
            'Nasional',
            'Internasional',
            'Liputan Khusus',
            'Teknologi',
            'Kesenian',
            'Hiburan',
            'Kesehatan',
            'Olahraga',
            'Opini',
            'Esai'
        ];

        $results = collect();

        foreach ($categories as $kategori) {
            $berita = self::where('kategori', $kategori)
                ->where('visibilitas', 'public')
                ->whereDate('tanggal_diterbitkan', $todayJakarta)
                ->withCount([
                    'reaksi as suka_count' => function ($query) {
                        $query->where('jenis_reaksi', 'Suka');
                    }
                ])
                ->orderByDesc('suka_count')
                ->orderByDesc('view_count')
                ->orderByDesc('tanggal_diterbitkan')
                ->first();

            if (!$berita) {
                $berita = self::where('kategori', $kategori)
                    ->where('visibilitas', 'public')
                    ->withCount([
                        'reaksi as suka_count' => function ($query) {
                            $query->where('jenis_reaksi', 'Suka');
                        }
                    ])
                    ->orderByDesc('suka_count')
                    ->orderByDesc('view_count')
                    ->orderByDesc('tanggal_diterbitkan')
                    ->first();
            }

            if ($berita) {
                $results->push($berita);
            }
        }

        return $results;
    }

    public function getFirstImageAttribute(): string
    {
        if (preg_match('/<img[^>]+src="([^">]+)"/i', $this->konten_berita, $matches)) {
            return $matches[1];
        }
        return $this->gambar ?? 'https://via.placeholder.com/400x200';
    }

    public function getCategorySlugAttribute()
    {
        $mapping = [
            'Kampus' => 'kampus',
            'Kesehatan' => 'kesehatan',
            'KesenianHiburan' => 'kesenian-hiburan',
            'Liputan Khusus' => 'liputan-khusus',
            'NasionalInternasional' => 'nasional-internasional',
            'Olahraga' => 'olahraga',
            'OpiniEsai' => 'opini-esai',
            'Teknologi' => 'teknologi',
            'Hiburan' => 'hiburan',
            'Esai' => 'esai',
        ];

        return $mapping[$this->kategori] ?? Str::slug($this->kategori);
    }

    public function getArticleUrlAttribute()
    {
        return url("/kategori/{$this->category_slug}/read?a={$this->id}");
    }

    public function getExcerptAttribute()
    {
        $cleanedContent = preg_replace('/&nbsp;/i', ' ', strip_tags($this->konten_berita));
        return Str::limit($cleanedContent, 150);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public function reaksi()
    {
        return $this->hasMany(\App\Models\UserReact\Reaksi::class, 'item_id', 'id')
            ->where('reaksi_type', 'berita');
    }
}
