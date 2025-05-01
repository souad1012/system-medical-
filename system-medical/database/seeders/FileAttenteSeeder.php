<?php

namespace Database\Seeders;

use App\Models\Consultation;
use App\Models\FileAttente;
use Illuminate\Database\Seeder;

class FileAttenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create file d'attente entries for existing consultations
        $position = 1;
        
        Consultation::where('statut', 'planifiée')->each(function ($consultation) use (&$position) {
            // Get the patient from the rendez-vous
            $patient = $consultation->rendezVous->patient;
            
            FileAttente::create([
                'patient_id' => $patient->id,
                'consultation_id' => $consultation->id,
                'heure_arrivee' => now()->subMinutes(rand(5, 60)),
                'position' => $position++,
                'statut' => 'en attente',
            ]);
        });
    }
}
