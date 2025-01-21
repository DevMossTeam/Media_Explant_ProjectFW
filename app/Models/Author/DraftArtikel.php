<?php

namespace App\Models\Author;

use Illuminate\Database\Eloquent\Model;

class DraftArtikel extends Model
{
    protected $table = 'artikel'; // Nama tabel
    protected $fillable = ['judul', 'konten_artikel', 'tanggal_diterbitkan', 'visibilitas', 'user_id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function getTimeAgoAttribute()
    {
        $now = now();
        $posted = $this->tanggal_diterbitkan;
        $diff = $now->diff($posted);

        if ($diff->y > 0) return "{$diff->y} tahun yang lalu";
        if ($diff->m > 0) return "{$diff->m} bulan yang lalu";
        if ($diff->d > 0) return "{$diff->d} hari yang lalu";
        if ($diff->h > 0) return "{$diff->h} jam yang lalu";
        if ($diff->i > 0) return "{$diff->i} menit yang lalu";
        return "baru saja";
    }
}
