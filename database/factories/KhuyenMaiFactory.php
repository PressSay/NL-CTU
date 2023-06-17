<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KhuyenMai>
 */
class KhuyenMaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'TenKhuyenMai' => fake()->name(),
            'NgayBatDau' => fake()->date(),
            'NgayKetThuc' => fake()->date(),
            'GiamGia' => fake()->numberBetween(0, 100),
        ];
    }
}
