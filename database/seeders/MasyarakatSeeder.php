<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Masyarakat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasyarakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'masyarakat')->get();

        $users->each(function ($user) {
            Masyarakat::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
