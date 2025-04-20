<?php

namespace App\Models\API;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user_id', 'isi_komentar', 'tanggal_komentar', 'komentar_type', 'item_id'];

    public function bookmarkable()
    {
        return $this->morphTo('bookmarkable', 'item_id', 'bookmark_type');
    }
}
