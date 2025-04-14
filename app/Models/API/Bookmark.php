<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\API\Berita;
use App\Models\User;

class Bookmark extends Model
{
    protected $table = 'bookmark';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'user_id', 'berita_id', 'tanggal_bookmark'
    ];

    // Generate otomatis ID dan tanggal saat data dibuat
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = strtoupper(Str::random(12)); // ID kombinasi huruf angka
            $model->tanggal_bookmark = Carbon::now(); // Waktu saat ini
        });
    }

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

