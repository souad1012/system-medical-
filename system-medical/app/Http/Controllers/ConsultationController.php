<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\RendezVous;
use App\Models\Salle;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = Consultation::with(['rendezVous.patient', 'salle'])->latest()->paginate(10);
        return view('consultations.index', compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rendezVous = RendezVous::where('confirme', true)
            ->whereDoesntHave('consultation')
            ->with('patient')
            ->get();
        $salles = Salle::where('disponible', true)->get();
        
        return view('consultations.create', compact('rendezVous', 'salles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rendez_vous_id' => 'required|exists:rendez_vous,id',
            'salle_id' => 'required|exists:salles,id',
            'heure_debut' => 'required|date',
            'heure_fin' => 'nullable|date|after:heure_debut',
            'type' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'statut' => 'required|string|max:255',
        ]);

        Consultation::create($validated);

        return redirect()->route('consultations.index')
            ->with('success', 'Consultation créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultation $consultation)
    {
        $consultation->load(['rendezVous.patient', 'salle', 'fileAttente']);
        return view('consultations.show', compact('consultation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultation $consultation)
    {
        $rendezVous = RendezVous::where('confirme', true)
            ->with('patient')
            ->get();
        $salles = Salle::all();
        
        return view('consultations.edit', compact('consultation', 'rendezVous', 'salles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation $consultation)
    {
        $validated = $request->validate([
            'rendez_vous_id' => 'required|exists:rendez_vous,id',
            'salle_id' => 'required|exists:salles,id',
            'heure_debut' => 'required|date',
            'heure_fin' => 'nullable|date|after:heure_debut',
            'type' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'statut' => 'required|string|max:255',
        ]);

        $consultation->update($validated);

        return redirect()->route('consultations.index')
            ->with('success', 'Consultation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();

        return redirect()->route('consultations.index')
            ->with('success', 'Consultation supprimée avec succès.');
    }
}
