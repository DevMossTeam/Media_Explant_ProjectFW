<?php

namespace App\Models\Author;

use Illuminate\Database\Eloquent\Model;

class Published extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'judul', 'tanggal_diterbitkan', 'view_count', 'user_id',
        'kategori', 'konten_berita', 'visibilitas'
    ];
}
