<?php

namespace App\Models\Author;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karya extends Model
{
    use HasFactory;

    protected $table = 'karya'; // Sesuai dengan nama tabel di database

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'creator',
        'judul',
        'deskripsi',
        'kategori',
        'media',
        'release_date',
        'visibilitas'
    ];
}
