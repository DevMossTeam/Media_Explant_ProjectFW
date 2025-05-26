<?php

namespace App\Models\Produk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Majalah extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'judul',
        'kategori',
        'media',
        'deskripsi',
        'release_date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public static function getHomeMajalah($limit = 6)
    {
        return self::where('kategori', 'Majalah')
            ->where('visibilitas', 'public')
            ->orderBy('release_date', 'desc')
            ->take($limit)
            ->get();
    }
}
