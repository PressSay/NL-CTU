<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ThongSoSanPham>
 */
class ThongSoSanPhamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'TenThongSo' => fake()->name(),
            'ChiTiet' => fake()->text(),
        ];
    }
}
