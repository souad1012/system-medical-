<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileAttente extends Model
{
    use HasFactory;

    protected $table = 'file_attente';

    protected $fillable = [
        'patient_id',
        'consultation_id',
        'heure_arrivee',
        'position',
        'statut',
    ];

    protected $casts = [
        'heure_arrivee' => 'datetime',
    ];

    /**
     * Get the patient that owns the file d'attente.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the consultation that owns the file d'attente.
     */
    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }
}
