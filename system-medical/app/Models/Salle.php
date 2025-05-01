<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'capacite',
        'disponible',
    ];

    protected $casts = [
        'disponible' => 'boolean',
    ];

    /**
     * Get the consultations for the salle.
     */
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }
}
