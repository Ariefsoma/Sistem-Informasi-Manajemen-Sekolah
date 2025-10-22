<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;

class MapUsersToProfilesSeeder extends Seeder
{
    public function run(): void
    {
        // map guru@example.test to first guru or by email
        $guruUser = User::where('email','guru@example.test')->first();
        $guru = Guru::first();
        if ($guruUser && $guru) {
            $guru->user_id = $guruUser->id;
            $guru->save();
        }

        // map siswa@example.test to first siswa if exists
        $siswaUser = User::where('email','siswa@example.test')->first();
        $siswa = Siswa::first();
        if ($siswaUser && $siswa) {
            $siswa->user_id = $siswaUser->id;
            $siswa->save();
        }

        // map orang_tua user to parent_user_id of first siswa if present
        $ortuUser = User::where('email','ortu@example.test')->first();
        if ($ortuUser && $siswa) {
            $siswa->parent_user_id = $ortuUser->id;
            $siswa->save();
        }
    }
}
