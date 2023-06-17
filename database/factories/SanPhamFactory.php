<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SanPham>
 */
class SanPhamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'TenSanPham' => fake()->name(),
            'SoLuong' => fake()->numberBetween(0, 1000),
            'MoTa' => fake()->text(),
            'Show' => fake()->numberBetween(0, 1),
            'GiaTri' => fake()->numberBetween(0, 1000),
        ];
    }
}
