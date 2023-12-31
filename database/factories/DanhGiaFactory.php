<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DanhGia>
 */
class DanhGiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Star' => fake()->numberBetween(1, 5),
            'NoiDung' => fake()->text(),
            'NgayDanhGia' => fake()->date(),
        ];
    }
}
