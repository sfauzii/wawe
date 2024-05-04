<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\TravelPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\transaction>
 */
class TransactionFactory extends Factory
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
            'users_id' => User::factory(), // Use User factory to create associated user
            'additional_visa' => $this->faker->numberBetween(0, 1), // Example: Generate a random additional_visa value (0 or 1)
            'transaction_total' => $this->faker->numberBetween(1000000, 5000000), // Example: Generate a random transaction_total value
            'transaction_status' => $this->faker->randomElement(['IN_CART, PENDING, SUCCESS, CANCEL, FAILED']), // Example: Generate a random transaction_status value
        ];
    }
}
