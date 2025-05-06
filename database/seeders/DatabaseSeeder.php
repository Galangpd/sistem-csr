<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Masyarakat;
use App\Models\Perusahaan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::create([
            'name' => 'test user',
            'username' => 'test123',
            'password' => Hash::make('admin123'),
            'role' => 'perusahaan',
        ]);

        User::factory(10)->create();
        $this->call([
            PerusahaanSeeder::class,
            MasyarakatSeeder::class,
        ]);
    }
}
