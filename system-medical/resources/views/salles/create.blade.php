<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter une salle') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('salles.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nom') border-red-500 @enderror" required>
                    @error('nom')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type:</label>
                    <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('type') border-red-500 @enderror" required>
                        <option value="">Sélectionner un type</option>
                        <option value="Consultation" {{ old('type') == 'Consultation' ? 'selected' : '' }}>Consultation</option>
                        <option value="Chirurgie" {{ old('type') == 'Chirurgie' ? 'selected' : '' }}>Chirurgie</option>
                        <option value="Radiologie" {{ old('type') == 'Radiologie' ? 'selected' : '' }}>Radiologie</option>
                        <option value="Urgence" {{ old('type') == 'Urgence' ? 'selected' : '' }}>Urgence</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="capacite" class="block text-gray-700 text-sm font-bold mb-2">Capacité:</label>
                    <input type="number" name="capacite" id="capacite" value="{{ old('capacite') }}" min="1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('capacite') border-red-500 @enderror" required>
                    @error('capacite')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="disponible" class="flex items-center">
                        <input type="checkbox" name="disponible" id="disponible" value="1" {{ old('disponible') ? 'checked' : '' }} class="mr-2">
                        <span class="text-gray-700 text-sm font-bold">Disponible</span>
                    </label>
                </div>
                
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ajouter
                    </button>
                    <a href="{{ route('salles.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
