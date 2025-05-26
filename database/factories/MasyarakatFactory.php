<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Masyarakat;
use App\Models\BidangUsaha;
use Illuminate\Support\Arr;
use App\Models\JenisBantuan;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasyarakatFactory extends Factory
{
    protected $model = Masyarakat::class;

    public function definition(): array
    {
        $bidang_usaha = BidangUsaha::inRandomOrder()->value('nama');
        $jenisbantuan = JenisBantuan::inRandomOrder()->value('nama');

        $provinsi = Province::inRandomOrder()->value('code');
        $kabupaten = City::inRandomOrder()->value('code');
        $kecamatan = District::inRandomOrder()->value('code');
        $kalurahan = Village::inRandomOrder()->value('code');

        return [
            'user_id' => User::factory()->state(['role' => 'masyarakat']),
            'nama_masyarakat' => $this->faker->company(),
            'logo' => 'asset/user.png',
            'bidang_usaha' => $bidang_usaha,
            'jenis_bantuan' => $jenisbantuan,
            'alamat' => $this->faker->address(),
            'kalurahan' => $kalurahan,
            'kecamatan' => $kecamatan,
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi,
        ];
    }
}
