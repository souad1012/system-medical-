<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RendezVous extends Model
{
    use HasFactory;

    protected $table = 'rendez_vous';

    protected $fillable = [
        'patient_id',
        'date_heure',
        'motif',
        'confirme',
    ];

    protected $casts = [
        'date_heure' => 'datetime',
        'confirme' => 'boolean',
    ];

    /**
     * Get the patient that owns the rendez-vous.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the consultation associated with the rendez-vous.
     */
    public function consultation(): HasOne
    {
        return $this->hasOne(Consultation::class);
    }
}
