<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salle>
 */
class SalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['Consultation', 'Chirurgie', 'Radiologie', 'Urgence'];
        
        return [
            'nom' => 'Salle ' . fake()->unique()->randomNumber(3),
            'type' => fake()->randomElement($types),
            'capacite' => fake()->numberBetween(1, 10),
            'disponible' => fake()->boolean(80), // 80% chance of being available
        ];
    }
}
