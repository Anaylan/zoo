<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    protected $species = ["Mammals", "Fish", "Birds", "Reptiles"];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'species' => $this->species[fake()->numberBetween(0, count($this->species) - 1)],
            'name' => fake()->name(),
            'age' => fake()->randomDigit(),
            'description' => fake()->text(),
            'cage_id' => fake()->numberBetween(1, Cage::count())
        ];
    }
}
