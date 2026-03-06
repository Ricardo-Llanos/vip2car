<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    protected static array $client_ids;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client_ids = static::$client_ids ??= Client::query()->pluck('id')->toArray();

        return [
            'client_id' => fake()->randomElement($client_ids),
            'plate' => fake()->unique()->toUpper(fake()->bothify('???-###')),
            'brand' => fake()->text(50),
            'model' => fake()->text(50),
            'manufacturing_year' => fake()->numberBetween(1600, 2026), // Desde 1996 -> now()
        ];
    }
}
