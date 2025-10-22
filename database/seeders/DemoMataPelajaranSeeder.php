<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;

class DemoMataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $mapels = ['Matematika','Bahasa Indonesia','IPA'];
        foreach ($mapels as $m) {
            MataPelajaran::firstOrCreate(['nama'=>$m]);
        }
    }
}
