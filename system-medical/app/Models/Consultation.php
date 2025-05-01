<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'rendez_vous_id',
        'salle_id',
        'heure_debut',
        'heure_fin',
        'type',
        'notes',
        'statut',
    ];

    protected $casts = [
        'heure_debut' => 'datetime',
        'heure_fin' => 'datetime',
    ];

    /**
     * Get the rendez-vous that owns the consultation.
     */
    public function rendezVous(): BelongsTo
    {
        return $this->belongsTo(RendezVous::class);
    }

    /**
     * Get the salle that owns the consultation.
     */
    public function salle(): BelongsTo
    {
        return $this->belongsTo(Salle::class);
    }

    /**
     * Get the file d'attente associated with the consultation.
     */
    public function fileAttente(): HasOne
    {
        return $this->hasOne(FileAttente::class);
    }
}
