<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisNaskah>
 */
class JenisNaskahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naskah_id' => random_int(1, 5),
            'nama' => fake()->name(),
            'kode' => Str::random(10),
        ];
    }
}
