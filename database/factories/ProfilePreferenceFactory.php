<?php

namespace Database\Factories;

use App\Models\Kriteria;
use App\Models\Perusahaan;
use App\Models\BidangUsaha;
use Illuminate\Support\Arr;
use App\Models\JenisBantuan;
use App\Models\ProfilePreference;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfilePreference>
 */
class ProfilePreferenceFactory extends Factory
{
    protected $model = ProfilePreference::class;

    public function definition(): array
    {

        $allKriteria = Kriteria::inRandomOrder()->pluck('id')->toArray();

        $core_factor = collect($allKriteria)->random(rand(1, 2))->toArray();
        $secondary_factor = array_values(array_diff($allKriteria, $core_factor));

        $bidangUsaha = BidangUsaha::inRandomOrder()->pluck('id')->toArray();

        $jenisBantuan = JenisBantuan::inRandomOrder()->pluck('id')->toArray();

        $provinsi = Province::inRandomOrder()->first();
        $kabupaten = City::where('province_code', $provinsi?->code)->inRandomOrder()->first();
        $kecamatan = District::where('city_code', $kabupaten?->code)->inRandomOrder()->first();
        $kalurahan = Village::where('district_code', $kecamatan?->code)->inRandomOrder()->first();

        return [
            'id_perusahaan' => Perusahaan::factory(),
            'core_factor' => $core_factor,
            'secondary_factor' => $secondary_factor,
            'bidang_usaha' => $bidangUsaha,
            'jenis_bantuan' => $jenisBantuan,
            'provinsi' => $provinsi->code,
            'kabupaten' => $kabupaten->code,
            'kecamatan' => $kecamatan->code,
            'kalurahan' => $kalurahan->code,
        ];
    }
}
