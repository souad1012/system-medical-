<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter une consultation') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('consultations.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="rendez_vous_id" class="block text-gray-700 text-sm font-bold mb-2">Rendez-vous:</label>
                    <select name="rendez_vous_id" id="rendez_vous_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('rendez_vous_id') border-red-500 @enderror" required>
                        <option value="">Sélectionner un rendez-vous</option>
                        @foreach ($rendezVous as $rdv)
                            <option value="{{ $rdv->id }}" {{ old('rendez_vous_id') == $rdv->id ? 'selected' : '' }}>
                                {{ $rdv->patient->nom }} {{ $rdv->patient->prenom }} - {{ $rdv->date_heure->format('d/m/Y H:i') }} - {{ $rdv->motif }}
                            </option>
                        @endforeach
                    </select>
                    @error('rendez_vous_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="salle_id" class="block text-gray-700 text-sm font-bold mb-2">Salle:</label>
                    <select name="salle_id" id="salle_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('salle_id') border-red-500 @enderror" required>
                        <option value="">Sélectionner une salle</option>
                        @foreach ($salles as $salle)
                            <option value="{{ $salle->id }}" {{ old('salle_id') == $salle->id ? 'selected' : '' }}>
                                {{ $salle->nom }} ({{ $salle->type }}) - Capacité: {{ $salle->capacite }}
                            </option>
                        @endforeach
                    </select>
                    @error('salle_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="heure_debut" class="block text-gray-700 text-sm font-bold mb-2">Heure de début:</label>
                    <input type="datetime-local" name="heure_debut" id="heure_debut" value="{{ old('heure_debut') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('heure_debut') border-red-500 @enderror" required>
                    @error('heure_debut')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="heure_fin" class="block text-gray-700 text-sm font-bold mb-2">Heure de fin (optionnel):</label>
                    <input type="datetime-local" name="heure_fin" id="heure_fin" value="{{ old('heure_fin') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('heure_fin') border-red-500 @enderror">
                    @error('heure_fin')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type:</label>
                    <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('type') border-red-500 @enderror" required>
                        <option value="">Sélectionner un type</option>
                        <option value="Première visite" {{ old('type') == 'Première visite' ? 'selected' : '' }}>Première visite</option>
                        <option value="Suivi" {{ old('type') == 'Suivi' ? 'selected' : '' }}>Suivi</option>
                        <option value="Urgence" {{ old('type') == 'Urgence' ? 'selected' : '' }}>Urgence</option>
                        <option value="Spécialiste" {{ old('type') == 'Spécialiste' ? 'selected' : '' }}>Spécialiste</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes (optionnel):</label>
                    <textarea name="notes" id="notes" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="statut" class="block text-gray-700 text-sm font-bold mb-2">Statut:</label>
                    <select name="statut" id="statut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('statut') border-red-500 @enderror" required>
                        <option value="planifiée" {{ old('statut') == 'planifiée' ? 'selected' : '' }}>Planifiée</option>
                        <option value="en cours" {{ old('statut') == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="terminée" {{ old('statut') == 'terminée' ? 'selected' : '' }}>Terminée</option>
                        <option value="annulée" {{ old('statut') == 'annulée' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    @error('statut')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ajouter
                    </button>
                    <a href="{{ route('consultations.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
