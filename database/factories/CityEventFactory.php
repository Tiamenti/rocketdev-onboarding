<?php

namespace Database\Factories;

use App\Enums\CityEventStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityEventFactory extends Factory
{
    public function definition(): array
    {
        $startAt = fake()->dateTimeBetween('now', '+30 days');
        $endAt = (clone $startAt)->modify('+8 hours');

        return [
            'title' => fake()->sentence(nbWords: 4),
            'place' => fake()->streetName(),
            'start_at' => $startAt,
            'end_at' => fake()->dateTimeBetween($startAt, $endAt),
            'tags' => fake()->words(4),
            'capacity' => fake()->numberBetween(1, 5000),
            'status' => fake()->randomElement(CityEventStatus::cases()),
            'change_number' => fake()->numberBetween(1, 10),
        ];
    }
}
