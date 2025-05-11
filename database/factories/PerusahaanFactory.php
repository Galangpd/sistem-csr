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
            'nama_perusahaan' => $this->faker->company(),
            'logo' => 'asset/user.png',
            'bidang_usaha' => $this->faker->catchPhrase(),
            'alamat' => $this->faker->address(),
        ];
    }
}
