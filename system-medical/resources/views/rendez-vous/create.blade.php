<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un rendez-vous') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('rendez-vous.store') }}" method="POST">
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
                    <label for="date_heure" class="block text-gray-700 text-sm font-bold mb-2">Date et heure:</label>
                    <input type="datetime-local" name="date_heure" id="date_heure" value="{{ old('date_heure') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('date_heure') border-red-500 @enderror" required>
                    @error('date_heure')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="motif" class="block text-gray-700 text-sm font-bold mb-2">Motif:</label>
                    <input type="text" name="motif" id="motif" value="{{ old('motif') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('motif') border-red-500 @enderror" required>
                    @error('motif')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="confirme" class="flex items-center">
                        <input type="checkbox" name="confirme" id="confirme" value="1" {{ old('confirme') ? 'checked' : '' }} class="mr-2">
                        <span class="text-gray-700 text-sm font-bold">Confirmé</span>
                    </label>
                </div>
                
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ajouter
                    </button>
                    <a href="{{ route('rendez-vous.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
