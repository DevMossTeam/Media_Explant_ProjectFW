<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserReact\Reaksi;

class Berita extends Model
{
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

    public function reaksi()
    {
        return $this->morphMany(Reaksi::class, 'reaksiable', 'reaksi_type', 'item_id');
    }
}
