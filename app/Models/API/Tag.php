<?php

namespace App\Models\Berita;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Berita\Berita;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'nama_tag', 'berita_id'
    ];

    public function berita() {
        return $this->belongsTo(Berita::class, 'berita_id', 'id');
    }
}
