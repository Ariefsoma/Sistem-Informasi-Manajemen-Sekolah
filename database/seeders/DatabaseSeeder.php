<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SiswaSeeder;
use Database\Seeders\GuruSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SiswaSeeder::class,
            GuruSeeder::class,
            \Database\Seeders\AdminUserSeeder::class,
            \Database\Seeders\RoleUserSeeder::class,
            \Database\Seeders\MapUsersToProfilesSeeder::class,
            // \Database\Seeders\DemoNilaiAbsensiSeeder::class, // optional demo data
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
