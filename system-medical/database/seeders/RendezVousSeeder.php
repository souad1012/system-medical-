<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Database\Seeder;

class RendezVousSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create rendez-vous for existing patients
        Patient::all()->each(function ($patient) {
            RendezVous::factory(rand(1, 3))->create([
                'patient_id' => $patient->id,
            ]);
        });
    }
}
