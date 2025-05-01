<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\FileAttente;
use App\Models\Patient;
use Illuminate\Http\Request;

class FileAttenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fileAttentes = FileAttente::with(['patient', 'consultation.rendezVous'])
            ->orderBy('position')
            ->paginate(10);
        return view('file-attente.index', compact('fileAttentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        $consultations = Consultation::with('rendezVous.patient')
            ->where('statut', 'planifiée')
            ->get();
        
        return view('file-attente.create', compact('patients', 'consultations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'consultation_id' => 'required|exists:consultations,id',
            'heure_arrivee' => 'required|date',
            'statut' => 'required|string|max:255',
        ]);

        // Calculate the position (last position + 1)
        $lastPosition = FileAttente::max('position') ?? 0;
        $validated['position'] = $lastPosition + 1;

        FileAttente::create($validated);

        return redirect()->route('file-attente.index')
            ->with('success', 'Patient ajouté à la file d\'attente avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FileAttente $fileAttente)
    {
        $fileAttente->load(['patient', 'consultation.rendezVous', 'consultation.salle']);
        return view('file-attente.show', compact('fileAttente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FileAttente $fileAttente)
    {
        $patients = Patient::all();
        $consultations = Consultation::with('rendezVous.patient')->get();
        
        return view('file-attente.edit', compact('fileAttente', 'patients', 'consultations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FileAttente $fileAttente)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'consultation_id' => 'required|exists:consultations,id',
            'heure_arrivee' => 'required|date',
            'position' => 'required|integer|min:1',
            'statut' => 'required|string|max:255',
        ]);

        $fileAttente->update($validated);

        return redirect()->route('file-attente.index')
            ->with('success', 'File d\'attente mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FileAttente $fileAttente)
    {
        $fileAttente->delete();

        // Reorder positions for remaining entries
        $fileAttentes = FileAttente::orderBy('position')->get();
        $position = 1;
        
        foreach ($fileAttentes as $fa) {
            $fa->update(['position' => $position++]);
        }

        return redirect()->route('file-attente.index')
            ->with('success', 'Patient retiré de la file d\'attente avec succès.');
    }
}
