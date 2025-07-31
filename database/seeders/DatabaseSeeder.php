<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Masyarakat;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Perusahaan;
use Illuminate\Support\Str;
use App\Models\JenisBantuan;
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
            'username' => 'admin',
            'email' => 'sisteminformasicsr@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'status'       => 'approved',
            'verified_at'  => now(),
        ]);
        User::factory(10)->create();
        $this->call([
            BidangUsahaSeeder::class,
            JenisBantuanSeeder::class,
            PerusahaanSeeder::class,
            MasyarakatSeeder::class,
            KriteriaSeeder::class,
            ProfilePreferenceSeeder::class,
        ]);
    }
}
