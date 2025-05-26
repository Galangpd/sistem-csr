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
            ['nama' => 'pendidikan'],
            ['nama' => 'kesehatan'],
            ['nama' => 'budaya'],
            ['nama' => 'lingkungan'],
            ['nama' => 'agama'],
        ];

        BidangUsaha::insert($bidangUsaha);
    }
}
