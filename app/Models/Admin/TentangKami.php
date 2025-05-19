<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TentangKami extends Model
{
    protected $table = 'tentang_kami';

    protected $fillable = [
        'email',
        'nomorHp',
        'tentangKami',
        'facebook',
        'instagram',
        'linkedin',
        'youtube',
        'kodeEtik',
        'explantContributor'
    ];

    public $timestamps = false;
}
