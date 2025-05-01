<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'date_naissance',
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    /**
     * Get the rendez-vous for the patient.
     */
    public function rendezVous(): HasMany
    {
        return $this->hasMany(RendezVous::class);
    }

    /**
     * Get the file d'attente entries for the patient.
     */
    public function fileAttentes(): HasMany
    {
        return $this->hasMany(FileAttente::class);
    }

    /**
     * Get the patient's full name.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }
}
