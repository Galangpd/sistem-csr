<?php

namespace Database\Seeders;

use App\Models\BidangUsaha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidangUsaha = [
            ['nama' => 'Pendidikan'],
            ['nama' => 'Kewirausahaan'],
            ['nama' => 'Sosial'],
            ['nama' => 'Lingkungan'],
            ['nama' => 'Agama'],
            ['nama' => 'Kesehatan'],
        ];

        BidangUsaha::insert($bidangUsaha);
    }
}
