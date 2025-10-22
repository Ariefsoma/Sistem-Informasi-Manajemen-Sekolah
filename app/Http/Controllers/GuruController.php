<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::paginate(15);
        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required|unique:gurus,nip',
            'nama' => 'required',
        ]);
        Guru::create($data);
        return redirect()->route('guru.index')->with('success','Guru dibuat');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nip' => 'required',
            'nama' => 'required',
        ]);
        $guru->update($data);
        return redirect()->route('guru.index')->with('success','Guru diupdate');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return back()->with('success','Guru dihapus');
    }
}

