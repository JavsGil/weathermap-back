<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HistorialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'state' => $this->faker->state(),
            'country' => $this->faker->country(),
            'lat' => $this->faker->latitude($min = -90, $max = 90),
            'lon' => $this->faker->longitude($min = -180, $max = 180),
            'humidity' => $this->faker->numberBetween(0,100),
        ];
    }
}
