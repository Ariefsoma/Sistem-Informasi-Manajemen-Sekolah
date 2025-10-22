<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Absensi;

class DemoNilaiAbsensiSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = Siswa::first();
        if (! $siswa) return;

        // sample mapel ids may not exist; try to use existing mata_pelajarans
        $mapelIds = \App\Models\MataPelajaran::pluck('id')->take(3)->toArray();
        foreach ($mapelIds as $idx => $mp) {
            Nilai::create([
                'siswa_id' => $siswa->id,
                'mata_pelajaran_id' => $mp,
                'nilai' => 75 + ($idx * 5),
                'semester' => 'Genap',
                'tahun_ajaran' => '2024/2025',
            ]);
        }

        // create a few absensi rows
        Absensi::create(['siswa_id'=>$siswa->id,'tanggal'=>now()->subDays(2),'status'=>'hadir']);
        Absensi::create(['siswa_id'=>$siswa->id,'tanggal'=>now()->subDays(1),'status'=>'sakit','keterangan'=>'Flu']);
    }
}
