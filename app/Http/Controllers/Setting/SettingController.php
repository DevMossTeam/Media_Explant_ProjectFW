<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function umumSettings()
    {
        // Ambil UID pengguna dari cookie
        $userUid = Cookie::get('user_uid');

        // Default $user adalah null
        $user = null;

        // Ambil data pengguna jika UID tersedia
        if ($userUid) {
            $user = User::where('uid', $userUid)
                ->select('nama_pengguna', 'password', 'email', 'nama_lengkap')
                ->first();
        }

        // Debugging: Pastikan $user dikirim
        // dd($user);

        // Kirim $user ke view
        return view('settings.umum', ['user' => $user]);
    }

    public function tempPreview(Request $request)
    {
        $userUid = Cookie::get('user_uid');
        $user = User::where('uid', $userUid)->first();

        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $data = file_get_contents($image);
            session(['temp_profile_pic' => base64_encode($data)]);
        }

        return response()->json(['success' => true]);
    }

    public function deleteProfilePic(Request $request)
    {
        $userUid = Cookie::get('user_uid');
        $user = User::where('uid', $userUid)->first();

        if ($user) {
            $user->profile_pic = null;
            $user->save();
        }

        return response()->json(['success' => true]);
    }

    public function loadPartial($section)
    {
        $user = auth()->user();

        if (view()->exists("settings.partials.$section")) {
            return view("settings.partials.$section", compact('user'))->render();
        }

        return response()->json(['error' => 'Partial not found'], 404);
    }
}
