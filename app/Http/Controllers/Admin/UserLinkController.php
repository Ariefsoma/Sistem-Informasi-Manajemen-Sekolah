<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;

class UserLinkController extends Controller
{
    public function index()
    {
        $q = request('q');
        $usersQuery = User::orderBy('id','desc');
        if ($q) {
            $usersQuery->where('email','like',"%{$q}%")->orWhere('name','like',"%{$q}%");
        }
        $users = $usersQuery->paginate(25)->withQueryString();
        $gurus = Guru::all();
        $siswas = Siswa::all();
        $parents = User::where('role', 'orang_tua')->get();
        return view('admin.user_links.index', compact('users','gurus','siswas','q','parents'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'map_type' => 'required|in:guru,siswa,parent',
            'profile_id' => 'nullable|integer',
        ]);

        $user = User::find($data['user_id']);
        if (! $user) return back()->withErrors(['user'=>'User tidak ditemukan']);

        if ($data['map_type'] === 'guru') {
            $guru = Guru::find($data['profile_id']);
            if (! $guru) return back()->withErrors(['profile'=>'Guru tidak ditemukan']);
            $guru->user_id = $user->id;
            $guru->save();
        } elseif ($data['map_type'] === 'siswa') {
            $s = Siswa::find($data['profile_id']);
            if (! $s) return back()->withErrors(['profile'=>'Siswa tidak ditemukan']);
            $s->user_id = $user->id;
            $s->save();
        } else { // parent
            $s = Siswa::find($data['profile_id']);
            if (! $s) return back()->withErrors(['profile'=>'Siswa tidak ditemukan']);
            $s->parent_user_id = $user->id;
            $s->save();
        }

        return back()->with('success','Mapping berhasil diperbarui');
    }

    public function createParent(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
        ]);

        // create user with role orang_tua and a random password
        $password = \Illuminate\Support\Str::random(10);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($password),
            'role' => 'orang_tua',
        ]);

        // map to siswa
        $s = Siswa::find($data['siswa_id']);
        $s->parent_user_id = $user->id;
        $s->save();

        return back()->with('success', "Orang tua dibuat dan di-mapping. Password sementara: $password");
    }

    public function unmap(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:guru,siswa,parent',
            'id' => 'required|integer',
        ]);

        if ($data['type'] === 'guru') {
            $g = Guru::find($data['id']);
            if ($g) { $g->user_id = null; $g->save(); }
        } elseif ($data['type'] === 'siswa') {
            $s = Siswa::find($data['id']);
            if ($s) { $s->user_id = null; $s->save(); }
        } else { // parent
            $s = Siswa::find($data['id']);
            if ($s) { $s->parent_user_id = null; $s->save(); }
        }

        return back()->with('success','Mapping berhasil dihapus');
    }
}
