<?php

namespace Database\Factories;

use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ride>
 */
class RideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'accepted', 'ongoing', 'completed', 'cancelled']);
        
        return [
            'client_id' => User::where('role', 'client')->inRandomOrder()->first()?->id ?? User::factory()->create(['role' => 'client'])->id,
            'driver_id' => in_array($status, ['accepted', 'ongoing', 'completed']) 
                ? (User::where('role', 'driver')->inRandomOrder()->first()?->id ?? User::factory()->create(['role' => 'driver'])->id)
                : null,
            'pickup_address' => fake()->address(),
            'destination_address' => fake()->address(),
            'pickup_lat' => fake()->latitude(48.8, 48.9), // Near Paris
            'pickup_lng' => fake()->longitude(2.2, 2.4),
            'destination_lat' => fake()->latitude(48.8, 48.9),
            'destination_lng' => fake()->longitude(2.2, 2.4),
            'distance_km' => fake()->randomFloat(2, 2, 50),
            'price' => fake()->randomFloat(2, 10, 150),
            'status' => $status,
            'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
