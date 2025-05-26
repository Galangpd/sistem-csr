<?php

namespace Database\Factories;

use App\Models\Perusahaan;
use App\Models\BidangUsaha;
use Illuminate\Support\Arr;
use App\Models\JenisBantuan;
use App\Models\ProfilePreference;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfilePreference>
 */
class ProfilePreferenceFactory extends Factory
{
    protected $model = ProfilePreference::class;

    public function definition(): array
    {

        $bidangUsaha = BidangUsaha::inRandomOrder()->pluck('nama')->toArray();

        $jenisBantuan = JenisBantuan::inRandomOrder()->pluck('nama')->toArray();

        $provinsi = Province::inRandomOrder()->value('code');
        $kabupaten = City::inRandomOrder()->value('code');
        $kecamatan = District::inRandomOrder()->value('code');
        $kalurahan = Village::inRandomOrder()->value('code');

        return [
            'id_perusahaan' => Perusahaan::factory(),
            'bidang_usaha' => $bidangUsaha,
            'jenis_bantuan' => $jenisBantuan,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kalurahan' => $kalurahan,
        ];
    }
}
