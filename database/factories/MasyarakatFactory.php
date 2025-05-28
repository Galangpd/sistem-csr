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
        $bidang_usaha = BidangUsaha::inRandomOrder()->value('id');
        $jenisbantuan = JenisBantuan::inRandomOrder()->value('id');

        $provinsi = Province::inRandomOrder()->first();
        $kabupaten = City::where('province_code', $provinsi?->code)->inRandomOrder()->first();
        $kecamatan = District::where('city_code', $kabupaten?->code)->inRandomOrder()->first();
        $kalurahan = Village::where('district_code', $kecamatan?->code)->inRandomOrder()->first();

        return [
            'user_id' => User::factory()->state(['role' => 'masyarakat']),
            'nama_masyarakat' => $this->faker->company(),
            'logo' => 'asset/user.png',
            'bidang_usaha' => $bidang_usaha,
            'jenis_bantuan' => $jenisbantuan,
            'alamat' => $this->faker->address(),
            'provinsi' => $provinsi->code,
            'kabupaten' => $kabupaten->code,
            'kecamatan' => $kecamatan->code,
            'kalurahan' => $kalurahan->code,
        ];
    }
}
