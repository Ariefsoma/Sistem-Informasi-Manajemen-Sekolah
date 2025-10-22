<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $items = MataPelajaran::paginate(20);
        return view('matapelajaran.index', compact('items'));
    }

    public function create()
    {
        return view('matapelajaran.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nama' => 'required']);
        MataPelajaran::create($data);
        return redirect()->route('matapelajaran.index')->with('success','Mata pelajaran dibuat');
    }

    public function edit(MataPelajaran $matapelajaran)
    {
        return view('matapelajaran.edit', ['item' => $matapelajaran]);
    }

    public function update(Request $request, MataPelajaran $matapelajaran)
    {
        $data = $request->validate(['nama' => 'required']);
        $matapelajaran->update($data);
        return redirect()->route('matapelajaran.index')->with('success','Diperbarui');
    }

    public function destroy(MataPelajaran $matapelajaran)
    {
        $matapelajaran->delete();
        return back()->with('success','Dihapus');
    }
}

