<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Guru;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensis = Absensi::with('siswa')->orderBy('tanggal','desc')->paginate(20);
        return view('absensi.index', compact('absensis'));
    }

    public function create()
    {
        $siswas = Siswa::all();
        // Return bulk attendance form for guru
        return view('guru.absensi_bulk', compact('siswas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,ijin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);
        // map authenticated user to guru record
        $guru = Guru::where('user_id', auth()->id())->first();
        if (! $guru) {
            return redirect()->back()->withErrors(['unauthorized' => 'Akun Anda belum terhubung sebagai guru. Hubungi administrator.']);
        }
        $data['guru_id'] = $guru->id;
        Absensi::updateOrCreate([
            'siswa_id'=>$data['siswa_id'],'tanggal'=>$data['tanggal']
        ], $data);
        return redirect()->route('guru.absensi.index')->with('success','Absensi tersimpan');
    }

    // store bulk attendance for a date (array of siswa_id => status)
    public function storeBulk(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*.siswa_id' => 'required|integer|exists:siswas,id',
            'attendance.*.status' => 'required|in:hadir,ijin,sakit,alpha',
            'attendance.*.keterangan' => 'nullable|string',
        ]);

        $guru = Guru::where('user_id', auth()->id())->first();
        if (! $guru) {
            return redirect()->back()->withErrors(['unauthorized' => 'Akun Anda belum terhubung sebagai guru.']);
        }

        foreach ($data['attendance'] as $row) {
            $siswaId = $row['siswa_id'];
            $status = $row['status'];
            $keterangan = $row['keterangan'] ?? null;

            Absensi::updateOrCreate([
                'siswa_id' => $siswaId,
                'tanggal' => $data['tanggal'],
            ], [
                'guru_id' => $guru->id,
                'status' => $status,
                'keterangan' => $keterangan,
            ]);
        }

        return redirect()->route('guru.absensi.index')->with('success','Absensi tersimpan');
    }
}
