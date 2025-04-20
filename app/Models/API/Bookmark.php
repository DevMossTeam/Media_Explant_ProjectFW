<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bookmark extends Model
{
    use HasFactory;

    protected $table = 'bookmark';
    protected $primaryKey = 'id';
    public $incrementing = false; // penting karena id bukan auto-increment
    protected $keyType = 'string'; // id bertipe string
    public $timestamps = false;


    protected $fillable = ['user_id', 'tanggal_bookmark', 'bookmark_type', 'item_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = $model->id ?? Str::random(12);
            $model->tanggal_bookmark = now();
        });
    }

    public function bookmarkable()
    {
        return $this->morphTo();
    }
}
