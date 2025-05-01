<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un patient') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nom') border-red-500 @enderror" required>
                    @error('nom')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('prenom') border-red-500 @enderror" required>
                    @error('prenom')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="telephone" class="block text-gray-700 text-sm font-bold mb-2">Téléphone:</label>
                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telephone') border-red-500 @enderror" required>
                    @error('telephone')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="date_naissance" class="block text-gray-700 text-sm font-bold mb-2">Date de naissance:</label>
                    <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('date_naissance') border-red-500 @enderror" required>
                    @error('date_naissance')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ajouter
                    </button>
                    <a href="{{ route('patients.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
