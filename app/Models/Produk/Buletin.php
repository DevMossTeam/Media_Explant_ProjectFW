<?php

namespace App\Models\Produk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Buletin extends Model
{
    use HasFactory;

    protected $table = 'produk'; // Ganti dengan nama tabel di database

    protected $fillable = [
        'judul',
        'kategori',
        'release_date',
        'media',
        'deskripsi',
    ];

    protected $dates = ['release_date'];

    public function getFormattedReleaseDateAttribute()
    {
        return Carbon::parse($this->release_date)->format('d M Y');
    }
}
