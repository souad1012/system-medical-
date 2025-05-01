<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Patients') }}
            </h2>
            <a href="{{ route('patients.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Ajouter un patient
            </a>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Prénom</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Téléphone</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Date de naissance</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($patients as $patient)
                            <tr>
                                <td class="py-4 px-6">{{ $patient->nom }}</td>
                                <td class="py-4 px-6">{{ $patient->prenom }}</td>
                                <td class="py-4 px-6">{{ $patient->telephone }}</td>
                                <td class="py-4 px-6">{{ $patient->date_naissance->format('d/m/Y') }}</td>
                                <td class="py-4 px-6 flex space-x-2">
                                    <a href="{{ route('patients.show', $patient) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                    <a href="{{ route('patients.edit', $patient) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                                    <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce patient?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 px-6 text-center text-gray-500">Aucun patient trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $patients->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
