<?php

namespace App\Models\Produk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buletin extends Model
{
    use HasFactory;

    protected $table = 'produk'; // Nama tabel di database
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'judul',
        'kategori',
        'media',
        'release_date',
    ];

    public static function getBuletinById($id)
    {
        $result = self::where('id', $id)
            ->where('kategori', 'Buletin')
            ->first();

        \Log::info("Query Buletin: ", ['id' => $id, 'result' => $result]);

        return $result;
    }
}
