<?php

namespace App\Models\Berita;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Berita\Berita;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'user_id', 'berita_id', 'isi_komentar', 'tanggal_komentar'
    ];

    public function berita() {
        return $this->belongsTo(Berita::class, 'berita_id', 'id');
    }
}

