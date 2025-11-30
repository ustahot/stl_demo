<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slot>
 */
class SlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $capacity = $this->faker->numberBetween(1, 12);

        return [
            'capacity' => $capacity,
            'remaining' => $capacity - $this->faker->numberBetween(0, $capacity),
        ];
    }
}
