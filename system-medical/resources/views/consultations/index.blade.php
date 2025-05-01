<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Consultations') }}
            </h2>
            <a href="{{ route('consultations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Ajouter une consultation
            </a>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Patient</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Salle</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Début</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($consultations as $consultation)
                            <tr>
                                <td class="py-4 px-6">{{ $consultation->rendezVous->patient->nom }} {{ $consultation->rendezVous->patient->prenom }}</td>
                                <td class="py-4 px-6">{{ $consultation->salle->nom }}</td>
                                <td class="py-4 px-6">{{ $consultation->heure_debut->format('d/m/Y H:i') }}</td>
                                <td class="py-4 px-6">{{ $consultation->type }}</td>
                                <td class="py-4 px-6">
                                    @if ($consultation->statut === 'planifiée')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Planifiée
                                        </span>
                                    @elseif ($consultation->statut === 'en cours')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            En cours
                                        </span>
                                    @elseif ($consultation->statut === 'terminée')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Terminée
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Annulée
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 flex space-x-2">
                                    <a href="{{ route('consultations.show', $consultation) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                    <a href="{{ route('consultations.edit', $consultation) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                                    <form action="{{ route('consultations.destroy', $consultation) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette consultation?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 px-6 text-center text-gray-500">Aucune consultation trouvée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $consultations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
