<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelPackage>
 */
class TravelPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->sentence),
            'location' => $this->faker->city,
            'about' => $this->faker->paragraph,
            'features' => $this->faker->paragraph,
            'departure_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'duration' => $this->faker->randomElement(['3 Days 2 Nights', '4 Days 3 Nights', '5 Days 4 Nights']),
            'type' => $this->faker->randomElement(['Open Trip', 'Private Trip']),
            'price' => $this->faker->numberBetween(1000000, 5000000),
        ];
    }
}
