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
            'id_profile' => 1,
            'name' => 'MA NURUL UMMAH',
            'logo' => '175319058659b25f73-e92b-43dd-83e8-3f98c9aff634.webp',
        ];
    }
}
