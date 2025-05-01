<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails de la salle') }}
            </h2>
            <div>
                <a href="{{ route('salles.edit', $salle) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Modifier
                </a>
                <a href="{{ route('salles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Informations de la salle</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nom</p>
                        <p class="mt-1">{{ $salle->nom }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Type</p>
                        <p class="mt-1">{{ $salle->type }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Capacité</p>
                        <p class="mt-1">{{ $salle->capacite }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Disponibilité</p>
                        <p class="mt-1">
                            @if ($salle->disponible)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Disponible
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Occupée
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Consultations prévues dans cette salle</h3>
                @if ($salle->consultations->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Patient</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Début</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Fin</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($salle->consultations as $consultation)
                                    <tr>
                                        <td class="py-4 px-6">{{ $consultation->rendezVous->patient->nom }} {{ $consultation->rendezVous->patient->prenom }}</td>
                                        <td class="py-4 px-6">{{ $consultation->heure_debut->format('d/m/Y H:i') }}</td>
                                        <td class="py-4 px-6">{{ $consultation->heure_fin ? $consultation->heure_fin->format('d/m/Y H:i') : 'Non définie' }}</td>
                                        <td class="py-4 px-6">{{ $consultation->type }}</td>
                                        <td class="py-4 px-6">{{ $consultation->statut }}</td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('consultations.show', $consultation) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">Aucune consultation prévue dans cette salle.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
