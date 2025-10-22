<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserRoleController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $usersQuery = User::orderBy('id', 'desc');
        if ($q) {
            $usersQuery->where('email', 'like', "%{$q}%")->orWhere('name', 'like', "%{$q}%");
        }
        $users = $usersQuery->paginate(25)->withQueryString();
        $roles = [
            'admin' => 'Administrator',
            'guru' => 'Guru',
            'siswa' => 'Siswa',
            'orang_tua' => 'Orang Tua',
            'kepala' => 'Kepala Sekolah',
        ];
        return view('admin.user_roles.index', compact('users','roles','q'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string',
        ]);

        $user = User::find($data['user_id']);
        if (! $user) {
            return back()->withErrors(['user'=>'User tidak ditemukan']);
        }

        $user->role = $data['role'];
        $user->save();

        return back()->with('success','Role user berhasil diperbarui');
    }
}
