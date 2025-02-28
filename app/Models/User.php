<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    public $timestamps = false; // Karena tidak ada timestamps di tabel user

    protected $fillable = [
        'uid',
        'nama_pengguna',
        'password',
        'email',
        'role',
        'nama_lengkap',
    ];

    protected $hidden = [
        'password',
    ];
}
