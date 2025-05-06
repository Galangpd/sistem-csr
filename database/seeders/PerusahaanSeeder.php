<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Perusahaan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'perusahaan')->get();

        $users->each(function ($user) {
            Perusahaan::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
