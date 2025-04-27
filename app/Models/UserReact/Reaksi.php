<?php

namespace App\Models\UserReact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaksi extends Model
{
    use HasFactory;

    protected $table = 'reaksi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'jenis_reaksi',
        'reaksi_type',
        'item_id',
        'tanggal_reaksi',
    ];

    public function reaksiable()
    {
        return $this->morphTo();
    }
}
