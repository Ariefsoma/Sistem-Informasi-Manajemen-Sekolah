<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::insert([
            [
                'nis' => 'S0001',
                'nama' => 'Ahmad Santoso',
                'tgl_lahir' => '2008-05-12',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Merdeka No.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis' => 'S0002',
                'nama' => 'Siti Nurhaliza',
                'tgl_lahir' => '2009-03-21',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Kenanga 12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
