<?php
namespace App\Models\Berita;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Berita\Berita;
use App\Models\User;

class Reaksi extends Model
{
    protected $table = 'reaksi';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = ['id', 'user_id', 'berita_id', 'jenis_reaksi', 'tanggal_reaksi'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = strtoupper(Str::random(12));
            $model->tanggal_reaksi = Carbon::now();
        });
    }

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
}

