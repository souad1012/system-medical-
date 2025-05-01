<?php

namespace Database\Factories;

use App\Models\RendezVous;
use App\Models\Salle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['Première visite', 'Suivi', 'Urgence', 'Spécialiste'];
        $statuts = ['planifiée', 'en cours', 'terminée', 'annulée'];
        
        $heureDebut = fake()->dateTimeBetween('now', '+2 weeks');
        $heureFin = (clone $heureDebut)->modify('+30 minutes');
        
        return [
            'rendez_vous_id' => RendezVous::factory(),
            'salle_id' => Salle::factory(),
            'heure_debut' => $heureDebut,
            'heure_fin' => fake()->boolean(80) ? $heureFin : null, // 80% chance of having an end time
            'type' => fake()->randomElement($types),
            'notes' => fake()->boolean(70) ? fake()->paragraph() : null, // 70% chance of having notes
            'statut' => fake()->randomElement($statuts),
        ];
    }
}
