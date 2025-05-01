<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RendezVous>
 */
class RendezVousFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $motifs = [
            'Consultation générale', 
            'Suivi médical', 
            'Examen de routine', 
            'Urgence',
            'Consultation spécialisée'
        ];
        
        return [
            'patient_id' => Patient::factory(),
            'date_heure' => fake()->dateTimeBetween('now', '+2 weeks'),
            'motif' => fake()->randomElement($motifs),
            'confirme' => fake()->boolean(70), // 70% chance of being confirmed
        ];
    }
}
