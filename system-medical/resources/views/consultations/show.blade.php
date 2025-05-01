<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails de la consultation') }}
            </h2>
            <div>
                <a href="{{ route('consultations.edit', $consultation) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Modifier
                </a>
                <a href="{{ route('consultations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Informations de la consultation</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Patient</p>
                        <p class="mt-1">
                            <a href="{{ route('patients.show', $consultation->rendezVous->patient) }}" class="text-blue-600 hover:text-blue-900">
                                {{ $consultation->rendezVous->patient->nom }} {{ $consultation->rendezVous->patient->prenom }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Rendez-vous</p>
                        <p class="mt-1">
                            <a href="{{ route('rendez-vous.show', $consultation->rendezVous) }}" class="text-blue-600 hover:text-blue-900">
                                {{ $consultation->rendezVous->date_heure->format('d/m/Y H:i') }} - {{ $consultation->rendezVous->motif }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Salle</p>
                        <p class="mt-1">
                            <a href="{{ route('salles.show', $consultation->salle) }}" class="text-blue-600 hover:text-blue-900">
                                {{ $consultation->salle->nom }} ({{ $consultation->salle->type }})
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Heure de début</p>
                        <p class="mt-1">{{ $consultation->heure_debut->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Heure de fin</p>
                        <p class="mt-1">{{ $consultation->heure_fin ? $consultation->heure_fin->format('d/m/Y H:i') : 'Non définie' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Type</p>
                        <p class="mt-1">{{ $consultation->type }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Statut</p>
                        <p class="mt-1">
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
                        </p>
                    </div>
                </div>
                
                @if ($consultation->notes)
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-500">Notes</p>
                        <p class="mt-1 whitespace-pre-line">{{ $consultation->notes }}</p>
                    </div>
                @endif
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">File d'attente</h3>
                @if ($consultation->fileAttente)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Heure d'arrivée</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Position</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-4 px-6">{{ $consultation->fileAttente->heure_arrivee->format('d/m/Y H:i') }}</td>
                                    <td class="py-4 px-6">{{ $consultation->fileAttente->position }}</td>
                                    <td class="py-4 px-6">{{ $consultation->fileAttente->statut }}</td>
                                    <td class="py-4 px-6">
                                        <a href="{{ route('file-attente.show', $consultation->fileAttente) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="flex justify-between items-center">
                        <p class="text-gray-500">Ce patient n'est pas encore dans la file d'attente pour cette consultation.</p>
                        @if ($consultation->statut === 'planifiée')
                            <a href="{{ route('file-attente.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Ajouter à la file d'attente
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
