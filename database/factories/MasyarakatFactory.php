<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Masyarakat;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasyarakatFactory extends Factory
{
    protected $model = Masyarakat::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'masyarakat']),
            'nama_masyarakat' => $this->faker->company(),
            'logo' => 'asset/user.png',
            'bidang_usaha' => Arr::random([
                'pendidikan', 
                'kesehatan',
                'budaya',
                'lingkungan',
                'agama',
            ]),
            'jenis_bantuan' => Arr::random([
                'tunai', 
                'sarana',
                'peralatan',
                'pelatihan',
            ]),
            'alamat' => $this->faker->address(),
            'kalurahan' => Arr::random([
                'sendangrejo', 
                'sendangsari',
                'sendangmulyo',
                'sendangarum',
            ]),
            'kecamatan' => Arr::random([
                'minggir', 
                'moyudan',
                'gamping',
                'godean',
            ]),
            'kabupaten' => Arr::random([
                'sleman', 
                'bantul',
                'kulonprogo',
                'gunungkidul',
            ]),
            'provinsi' => Arr::random([
                'DIY', 
                'Jateng',
                'Jatim',
                'Jabar',
            ]),
        ];
    }
}
