<?php

namespace Database\Factories;

use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerusahaanFactory extends Factory
{
    protected $model = Perusahaan::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'perusahaan']),
            'nama_perusahaan' => fake()->company(),
            'logo' => 'asset/user.png',
            'bidang_usaha' => fake()->catchPhrase(),
            'alamat' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'telepon' => fake()->phoneNumber(),
        ];
    }
}
