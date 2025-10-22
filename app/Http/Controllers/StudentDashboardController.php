<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Absensi;
use App\Models\Siswa;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // determine associated siswa record (either user->siswa or parent)
        $siswa = Siswa::where('user_id', $user->id)->orWhere('parent_user_id', $user->id)->first();
        if (! $siswa) {
            return view('student.no-profile');
        }

        $nilais = Nilai::with('mataPelajaran')->where('siswa_id', $siswa->id)->get();
        $absensis = Absensi::where('siswa_id', $siswa->id)->orderBy('tanggal','desc')->get();

        return view('student.dashboard', compact('siswa','nilais','absensis'));
    }
}
