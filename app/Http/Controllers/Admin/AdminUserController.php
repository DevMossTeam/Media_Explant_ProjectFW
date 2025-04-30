<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    function user(Request $request) {
        $perPage = $request->input('perPage', 10); // Default is 10 users per page

        $users = User::paginate($perPage);

        return view('dashboard-admin.menu.menu_user', compact('users', 'perPage'));
    }
    
    public function findUserById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        return view('dashboard-admin.menu.user_detail', compact('user'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User berhasil dihapus.');
    }

}
