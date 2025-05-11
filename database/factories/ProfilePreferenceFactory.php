<?php

namespace Database\Factories;

use App\Models\Perusahaan;
use Illuminate\Support\Arr;
use App\Models\ProfilePreference;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfilePreference>
 */
class ProfilePreferenceFactory extends Factory
{
    protected $model = ProfilePreference::class;

    public function definition(): array
    {

        $bidangUsaha = ['pendidikan', 'kesehatan', 'budaya', 'lingkungan', 'agama'];
        $jenisBantuan = ['tunai', 'sarana', 'peralatan', 'pelatihan'];

        shuffle($bidangUsaha);
        shuffle($jenisBantuan);

        return [
            'id_perusahaan' => Perusahaan::factory(),
            'bidang_usaha' => $bidangUsaha,
            'jenis_bantuan' => $jenisBantuan,
            'provinsi' => Arr::random([
                'DIY', 
                'Jateng',
                'Jatim',
                'Jabar',
            ]),
            'kabupaten' => Arr::random([
                'sleman', 
                'bantul',
                'kulonprogo',
                'gunungkidul',
            ]),
            'kecamatan' => Arr::random([
                'minggir', 
                'moyudan',
                'gamping',
                'godean',
            ]),
            'kalurahan' => Arr::random([
                'sendangrejo', 
                'sendangsari',
                'sendangmulyo',
                'sendangarum',
            ]),
        ];
    }
}
