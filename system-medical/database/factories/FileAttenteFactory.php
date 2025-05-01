<?php

namespace Database\Factories;

use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FileAttente>
 */
class FileAttenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuts = ['en attente', 'en consultation', 'terminé', 'absent'];
        
        return [
            'patient_id' => Patient::factory(),
            'consultation_id' => Consultation::factory(),
            'heure_arrivee' => fake()->dateTimeBetween('-1 hour', 'now'),
            'position' => fake()->unique()->numberBetween(1, 100),
            'statut' => fake()->randomElement($statuts),
        ];
    }
}
