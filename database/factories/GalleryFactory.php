<?php

namespace Database\Factories;

use App\Models\TravelPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'travel_packages_id' => TravelPackage::factory(), // Use TravelPackage factory to create associated travel package
            'image' => $this->faker->imageUrl(), // Example: Generate a random image URL
        ];
    }
}
