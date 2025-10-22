<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Guru;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with(['siswa','mataPelajaran'])->paginate(20);
        return view('nilai.index', compact('nilais'));
    }

    public function create()
    {
        $siswas = Siswa::all();
        $mapels = MataPelajaran::all();
        return view('nilai.create', compact('siswas','mapels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'nilai' => 'nullable|numeric',
            'semester' => 'nullable|string',
            'tahun_ajaran' => 'nullable|string',
        ]);
        // map authenticated user -> guru record (gurus.user_id)
        $guru = Guru::where('user_id', auth()->id())->first();
        if (! $guru) {
            return redirect()->back()->withErrors(['unauthorized' => 'Akun Anda belum terhubung sebagai guru. Hubungi administrator.']);
        }
        $data['guru_id'] = $guru->id;
        Nilai::create($data);
        return redirect()->route('guru.nilai.index')->with('success','Nilai disimpan');
    }
}
