<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('File d\'attente') }}
            </h2>
            <a href="{{ route('file-attente.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Ajouter un patient à la file d'attente
            </a>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Position</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Patient</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Consultation</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Heure d'arrivée</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($fileAttentes as $fileAttente)
                            <tr>
                                <td class="py-4 px-6">{{ $fileAttente->position }}</td>
                                <td class="py-4 px-6">{{ $fileAttente->patient->nom }} {{ $fileAttente->patient->prenom }}</td>
                                <td class="py-4 px-6">{{ $fileAttente->consultation->type }} - {{ $fileAttente->consultation->heure_debut->format('H:i') }}</td>
                                <td class="py-4 px-6">{{ $fileAttente->heure_arrivee->format('d/m/Y H:i') }}</td>
                                <td class="py-4 px-6">
                                    @if ($fileAttente->statut === 'en attente')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                    @elseif ($fileAttente->statut === 'en consultation')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            En consultation
                                        </span>
                                    @elseif ($fileAttente->statut === 'terminé')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Terminé
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Absent
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 flex space-x-2">
                                    <a href="{{ route('file-attente.show', $fileAttente) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                    <a href="{{ route('file-attente.edit', $fileAttente) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                                    <form action="{{ route('file-attente.destroy', $fileAttente) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir retirer ce patient de la file d\'attente?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 px-6 text-center text-gray-500">Aucun patient dans la file d'attente</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $fileAttentes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
