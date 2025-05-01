<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un patient à la file d\'attente') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('file-attente.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="patient_id" class="block text-gray-700 text-sm font-bold mb-2">Patient:</label>
                    <select name="patient_id" id="patient_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('patient_id') border-red-500 @enderror" required>
                        <option value="">Sélectionner un patient</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                {{ $patient->nom }} {{ $patient->prenom }}
                            </option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="consultation_id" class="block text-gray-700 text-sm font-bold mb-2">Consultation:</label>
                    <select name="consultation_id" id="consultation_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('consultation_id') border-red-500 @enderror" required>
                        <option value="">Sélectionner une consultation</option>
                        @foreach ($consultations as $consultation)
                            <option value="{{ $consultation->id }}" {{ old('consultation_id') == $consultation->id ? 'selected' : '' }}>
                                {{ $consultation->rendezVous->patient->nom }} {{ $consultation->rendezVous->patient->prenom }} - 
                                {{ $consultation->type }} - 
                                {{ $consultation->heure_debut->format('d/m/Y H:i') }}
                            </option>
                        @endforeach
                    </select>
                    @error('consultation_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="heure_arrivee" class="block text-gray-700 text-sm font-bold mb-2">Heure d'arrivée:</label>
                    <input type="datetime-local" name="heure_arrivee" id="heure_arrivee" value="{{ old('heure_arrivee', now()->format('Y-m-d\TH:i')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('heure_arrivee') border-red-500 @enderror" required>
                    @error('heure_arrivee')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="statut" class="block text-gray-700 text-sm font-bold mb-2">Statut:</label>
                    <select name="statut" id="statut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('statut') border-red-500 @enderror" required>
                        <option value="en attente" {{ old('statut') == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="en consultation" {{ old('statut') == 'en consultation' ? 'selected' : '' }}>En consultation</option>
                        <option value="terminé" {{ old('statut') == 'terminé' ? 'selected' : '' }}>Terminé</option>
                        <option value="absent" {{ old('statut') == 'absent' ? 'selected' : '' }}>Absent</option>
                    </select>
                    @error('statut')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ajouter
                    </button>
                    <a href="{{ route('file-attente.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
