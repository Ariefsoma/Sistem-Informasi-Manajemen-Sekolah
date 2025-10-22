<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guru::insert([
            [
                'nip' => 'G1001',
                'nama' => 'Budi Raharjo',
                'mata_pelajaran' => 'Matematika',
                'email' => 'budi@example.com',
                'telepon' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => 'G1002',
                'nama' => 'Nina Wijaya',
                'mata_pelajaran' => 'Bahasa Indonesia',
                'email' => 'nina@example.com',
                'telepon' => '082345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
