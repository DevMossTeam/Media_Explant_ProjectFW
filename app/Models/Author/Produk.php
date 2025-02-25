<?php

namespace App\Models\Author;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; // Matikan timestamps

    protected $fillable = [
        'id', 'judul', 'deskripsi', 'kategori', 'media', 'release_date', 'visibilitas'
    ];
}
