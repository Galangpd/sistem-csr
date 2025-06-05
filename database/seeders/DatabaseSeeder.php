<?php

namespace Database\Seeders;

use App\Models\JenisBantuan;
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
