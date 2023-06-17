<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DonHang>
 */
class DonHangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'HinhThucThanhToan' => fake()->text(),
            'TrangThai' => fake()->text(),
            'TongTien' => fake()->numberBetween(0, 999999999),
            'NgayLap' => fake()->date(),
            'GhiChu' => fake()->text(),
            'PhiShip' => fake()->numberBetween(0, 999999999)
        ];
    }
}
