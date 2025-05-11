<?php

namespace Database\Seeders;

use App\Models\Perusahaan;
use App\Models\ProfilePreference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilePreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perusahaans = Perusahaan::all();

        $perusahaans->each(function ($user) {
            ProfilePreference::factory()->create([
                'id_perusahaan' => $user->id,
            ]);
        });
    }
}
