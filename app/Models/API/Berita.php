<?php

// app/Models/API/Berita.php

namespace App\Models\API;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'berita';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'judul', 'konten_berita', 'tanggal_diterbitkan', 'kategori', 'user_id', 'visibilitas'
    ];

  // App\Models\API\Berita.php
    public function tags()
    {
        return $this->hasMany(Tag::class, 'berita_id', 'id');
    }


    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable', 'item_id', 'bookmark_type');
    }

    public function reaksis()
    {
        return $this->morphMany(Reaksi::class, 'reaksiable' ,'item_id', 'reaksi_type');
    }

    public function komentars()
    {
        return $this->morphMany(Komentar::class, 'komentarable','item_id', 'komentar_type');
    }
}


