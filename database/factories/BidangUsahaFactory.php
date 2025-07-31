<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BidangUsaha>
 */
class BidangUsahaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'nama' => Arr::random([
                'pendidikan', 
                'kesehatan',
                'budaya',
                'lingkungan',
                'agama',
                'kesehatan',
            ]),
        ];
    }
}
