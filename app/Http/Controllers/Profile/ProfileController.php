<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class ProfileController extends Controller
{
    public function mainProfile()
    {
        // Ambil UID pengguna dari cookie
        $userUid = Cookie::get('user_uid');
        
        // Ambil hanya kolom yang diperlukan dari database
        $user = $userUid 
            ? User::where('uid', $userUid)->select('nama_pengguna', 'nama_lengkap', 'role')->first() 
            : null;

        // Kirim data ke view
        return view('profile.mainProfile', compact('user'));
    }
}
