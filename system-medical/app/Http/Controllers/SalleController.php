<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salles = Salle::latest()->paginate(10);
        return view('salles.index', compact('salles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'disponible' => 'boolean',
        ]);

        Salle::create($validated);

        return redirect()->route('salles.index')
            ->with('success', 'Salle créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salle $salle)
    {
        return view('salles.show', compact('salle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salle $salle)
    {
        return view('salles.edit', compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salle $salle)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'disponible' => 'boolean',
        ]);

        $salle->update($validated);

        return redirect()->route('salles.index')
            ->with('success', 'Salle mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salle $salle)
    {
        $salle->delete();

        return redirect()->route('salles.index')
            ->with('success', 'Salle supprimée avec succès.');
    }
}
