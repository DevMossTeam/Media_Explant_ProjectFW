<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\API\Komentar;
use App\Models\API\Reaksi;
use App\Models\API\tag;
use App\Models\API\bookmark;

class Berita extends Model   


{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'id', 'judul', 'konten_berita', 'gambar', 'tanggal_diterbitkan', 'kategori', 'user_id', 'visibilitas'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public function komentar() {
        return $this->hasMany(Komentar::class, 'berita_id', 'id');
    }

    public function reaksi() {
        return $this->hasMany(Reaksi::class, 'berita_id', 'id');
    }

    public function tag() {
        return $this->hasMany(Tag::class, 'berita_id', 'id');
    }

    public function bookmark() {
        return $this->hasMany(Bookmark::class, 'berita_id', 'id');
    }
}
