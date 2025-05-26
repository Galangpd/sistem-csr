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
            ['nama' => 'tunai'],
            ['nama' => 'prasarana'],
            ['nama' => 'peralatan'],
            ['nama' => 'pelatihan'],
        ];

        JenisBantuan::insert($jenisbantuan);
    }
}
