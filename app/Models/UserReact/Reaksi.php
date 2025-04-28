<?php

namespace App\Models\UserReact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reaksi extends Model
{
    use HasFactory;

    protected $table = 'reaksi';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'jenis_reaksi',
        'reaksi_type',
        'item_id',
        'tanggal_reaksi',
    ];

    // Bikin ID pendek 12 karakter
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = self::generateShortId();
            }
        });
    }

    private static function generateShortId()
    {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 12);
    }
}
