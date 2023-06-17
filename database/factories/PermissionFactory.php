<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    
    public function definition(): array
    {
        $permission = array('Edit', 'View', 'Delete');
        
        return [
            'name' => $permission[rand(0, 2)],
            'Description' => 'test',
        ];
    }
}
