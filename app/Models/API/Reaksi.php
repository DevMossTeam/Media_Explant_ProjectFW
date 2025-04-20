<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaksi extends Model
{
    use HasFactory;

    protected $table = 'reaksi';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user_id', 'jenis_reaksi', 'tanggal_reaksi', 'reaksi_type', 'item_id'];

    public function reaksiable()
    {
        return $this->morphTo();
    }
}

