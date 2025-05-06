<?php

namespace Database\Factories;

use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasyarakatFactory extends Factory
{
    protected $model = Masyarakat::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'masyarakat']),
            'nama_masyarakat' => $this->faker->company(),
            'logo' => 'asset/logo-oia.svg',
            'bidang_usaha' => $this->faker->catchPhrase(),
            'alamat' => $this->faker->address(),
            'kalurahan' => $this->faker->streetName(),
            'kecamatan' => $this->faker->citySuffix(),
            'kabupaten' => $this->faker->city(),
            'provinsi' => $this->faker->state(),
        ];
    }
}
