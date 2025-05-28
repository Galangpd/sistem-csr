<?php

namespace Database\Seeders;

use App\Models\JenisBantuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBantuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisbantuan = [
            ['nama' => 'Uang Tunai'],
            ['nama' => 'Sarana dan Prasarana'],
            ['nama' => 'Peralatan Usaha'],
            ['nama' => 'Pelatihan'],
        ];

        JenisBantuan::insert($jenisbantuan);
    }
}
