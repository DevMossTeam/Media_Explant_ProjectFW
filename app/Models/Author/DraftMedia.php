<?php

namespace App\Models\Author;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftMedia extends Model
{
    use HasFactory;

    protected $table = 'draft_media'; // Sesuaikan dengan nama tabel di database

    protected $fillable = ['judul', 'konten_berita', 'tanggal_diterbitkan', 'visibilitas'];
}
