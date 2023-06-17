<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'avatar' => 'avatars/kFk1A2CsIowXWj4WqX5gsJQQVLQpiBXCBDEWPhzH.jpg',
/*             'First Name' => $this->faker->firstName,
            'Last Name' => $this->faker->lastName, */
            'gender' => $this->faker->boolean,
            'signature' => $this->faker->sentence,
        ];
    }
}
