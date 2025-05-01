<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rendezVous = RendezVous::with('patient')->latest()->paginate(10);
        return view('rendez-vous.index', compact('rendezVous'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        return view('rendez-vous.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_heure' => 'required|date',
            'motif' => 'required|string|max:255',
            'confirme' => 'boolean',
        ]);

        RendezVous::create($validated);

        return redirect()->route('rendez-vous.index')
            ->with('success', 'Rendez-vous créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RendezVous $rendezVou)
    {
        $rendezVous = $rendezVou->load('patient', 'consultation');
        return view('rendez-vous.show', compact('rendezVous'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RendezVous $rendezVou)
    {
        $patients = Patient::all();
        return view('rendez-vous.edit', compact('rendezVou', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RendezVous $rendezVou)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_heure' => 'required|date',
            'motif' => 'required|string|max:255',
            'confirme' => 'boolean',
        ]);

        $rendezVou->update($validated);

        return redirect()->route('rendez-vous.index')
            ->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RendezVous $rendezVou)
    {
        $rendezVou->delete();

        return redirect()->route('rendez-vous.index')
            ->with('success', 'Rendez-vous supprimé avec succès.');
    }
}
