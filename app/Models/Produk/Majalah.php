<?php

namespace App\Models\Produk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        return self::select('produk.*')
            ->where('kategori', 'Majalah')
            ->where('visibilitas', 'public')
            ->leftJoin(DB::raw("(SELECT item_id, COUNT(*) as suka_count
            FROM reaksi
            WHERE jenis_reaksi = 'Suka' AND reaksi_type = 'Produk'
            GROUP BY item_id) as r"), 'produk.id', '=', 'r.item_id')
            ->orderByDesc(DB::raw('COALESCE(r.suka_count, 0)'))
            ->orderByDesc('view_count')
            ->orderByDesc('release_date')
            ->take($limit)
            ->get();
    }
}
