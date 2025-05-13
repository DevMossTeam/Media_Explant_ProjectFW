<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;

class SettingController extends Controller
{
    public function umumSettings()
    {
        $userUid = Cookie::get('user_uid');
        $user = $userUid
            ? User::where('uid', $userUid)->select('nama_pengguna', 'password', 'email', 'nama_lengkap', 'profile_pic')->first()
            : null;

        return view('settings.umum', ['user' => $user]);
    }

    public function uploadTempProfilePic(Request $request)
    {
        $request->validate([
            'profile_pic' => 'required|image|max:20480', // 20MB
        ]);

        $image = $request->file('profile_pic');
        $base64 = base64_encode(file_get_contents($image->getRealPath()));

        session(['temp_profile_pic' => $base64]);

        return response()->json(['success' => true]);
    }

    public function saveProfile(Request $request)
    {
        $userUid = Cookie::get('user_uid');
        $user = $userUid ? User::where('uid', $userUid)->first() : null;

        if ($user && session('temp_profile_pic')) {
            $user->profile_pic = base64_decode(session('temp_profile_pic')); // simpan biner ke LONGBLOB
            $user->save();
            session()->forget('temp_profile_pic');
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
