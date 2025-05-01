<?php

namespace Database\Seeders;

use App\Models\Consultation;
use App\Models\RendezVous;
use App\Models\Salle;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create consultations for existing rendez-vous
        RendezVous::all()->each(function ($rendezVous) {
            // Only create consultations for confirmed rendez-vous
            if ($rendezVous->confirme) {
                $salle = Salle::where('disponible', true)->inRandomOrder()->first();
                
                if ($salle) {
                    Consultation::factory()->create([
                        'rendez_vous_id' => $rendezVous->id,
                        'salle_id' => $salle->id,
                        'heure_debut' => $rendezVous->date_heure,
                    ]);
                }
            }
        });
    }
}
