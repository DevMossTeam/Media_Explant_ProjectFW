<?php

namespace App\Models\Karya;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pantun extends Model
{
    protected $table = 'karya';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'judul',
        'deskripsi',
        'konten',
        'visibilitas',
        'kategori',
        'media',
        'release_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public $timestamps = false;
}
