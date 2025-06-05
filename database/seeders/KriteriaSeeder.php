<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = [
            ['nama' => 'Bidang Usaha'],
            ['nama' => 'Jenis Bantuan'],
            ['nama' => 'Lokasi'],
        ];

        Kriteria::insert($kriteria);
    }
}
