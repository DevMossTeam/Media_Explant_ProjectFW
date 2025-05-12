<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class Liked extends Model
{
    protected $table = 'reaksi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['user_id', 'item_id', 'jenis_reaksi', 'tanggal_reaksi'];

    public function berita()
    {
        return $this->belongsTo(\App\Models\Author\Published::class, 'item_id', 'id');
    }
}
