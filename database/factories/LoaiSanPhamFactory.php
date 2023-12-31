<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoaiSanPham>
 */
class LoaiSanPhamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'TenLoaiSanPham' => fake()->name(),
            'Show' => fake()->numberBetween(0, 1),
        ];
    }
}
