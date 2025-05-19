<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function user(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $searchTerm = $request->input('search', '');

        $query = User::query();

        // 🔍 Search
        if ($searchTerm) {
            $query->where('nama_pengguna', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%");
        }

        // 📦 Filter by role
        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        // 🗓️ Filter by date range
        if ($tanggalDari = $request->input('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $tanggalDari);
        }

        if ($tanggalSampai = $request->input('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $tanggalSampai);
        }

        // 🔁 Sort by date
        if ($order = $request->input('order')) {
            if ($order === 'terbaru') {
                $query->orderByDesc('created_at');
            } elseif ($order === 'terlama') {
                $query->orderBy('created_at');
            }
        }

        // 📄 Paginate and preserve query params
        $users = $query->paginate($perPage)->appends([
            'search' => $searchTerm,
            'perPage' => $perPage,
            'role' => $request->input('role'),
            'order' => $request->input('order'),
            'tanggal_dari' => $request->input('tanggal_dari'),
            'tanggal_sampai' => $request->input('tanggal_sampai'),
        ]);

        return view('dashboard-admin.menu.menu_user', compact('users', 'perPage', 'searchTerm'));
    }

    public function detail(Request $request, $id)
    {
        // Use findOrFail() to throw 404 if user not found
        $user = User::findOrFail($id);
        return view('dashboard-admin.menu.menu_user_detail', compact('user'));
    }

    public function deleteUser(Request $request, $uid)
    {
        $user = User::findOrFail($uid);
        $user->delete();
    
        return redirect()
            ->route('admin.user')
            ->with('success', 'Pengguna berhasil dihapus');
    }

    public function updateRole(Request $request, $uid)
    {
        $request->validate([
            'role' => 'required|in:Admin,Penulis,Pembaca',
        ]);

        $user = User::findOrFail($uid);
        $user->role = $request->input('role');
        $user->save();

        if ($request->ajax()) {
            return response()->json(['success' => 'Role berhasil diubah']);
        }

        return redirect()
            ->route('admin.user')
            ->with('success', 'Peran pengguna berhasil diubah');
    }
}