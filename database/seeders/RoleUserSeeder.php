<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'admin', 'email' => 'admin@example.test'],
            ['name' => 'guru', 'email' => 'guru@example.test'],
            ['name' => 'siswa', 'email' => 'siswa@example.test'],
            ['name' => 'orang_tua', 'email' => 'ortu@example.test'],
            ['name' => 'kepala', 'email' => 'kepala@example.test'],
        ];

        foreach ($roles as $r) {
            User::updateOrCreate(
                ['email' => $r['email']],
                [
                    'name' => ucfirst(str_replace('_', ' ', $r['name'])),
                    'password' => Hash::make('password'),
                    'is_admin' => $r['name'] === 'admin' ? true : false,
                    'role' => $r['name'],
                ]
            );
        }
    }
}
