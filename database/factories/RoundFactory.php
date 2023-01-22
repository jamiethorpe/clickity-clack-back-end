<?php

namespace Database\Factories;

use App\Actions\CreateTechnique;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Round>
 */
class RoundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'technique' => CreateTechnique::run(rand(2, 8)),
        ];
    }
}
