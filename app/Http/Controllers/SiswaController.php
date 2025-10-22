<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::paginate(15);
        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required',
        ]);
        Siswa::create($data);
        return redirect()->route('siswa.index')->with('success','Siswa dibuat');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nis' => 'required',
            'nama' => 'required',
        ]);
        $siswa->update($data);
        return redirect()->route('siswa.index')->with('success','Siswa diupdate');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return back()->with('success','Siswa dihapus');
    }
}

