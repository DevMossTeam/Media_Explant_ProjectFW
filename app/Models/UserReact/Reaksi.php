<?php

namespace App\Models\UserReact;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reaksi extends Model
{
    protected $table = 'reaksi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id', 'user_id', 'jenis_reaksi', 'tanggal_reaksi', 'reaksi_type', 'item_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::random(12);
        });
    }
}
