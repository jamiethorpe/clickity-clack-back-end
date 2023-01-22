<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Showdown>
 */
class ShowdownFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'completed_at' => rand(0, 1) ? $this->faker->dateTimeBetween('-1 year') : null,
        ];
    }

    public function completed()
    {
        return $this->state(fn (array $attributes) => [
            'completed_at' => $this->faker->dateTimeBetween('-1 year'),
        ]);
    }

    public function inProgress()
    {
        return $this->state(fn (array $attributes) => [
            'completed_at' => null,
        ]);
    }
}
