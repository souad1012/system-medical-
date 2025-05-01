<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails du rendez-vous') }}
            </h2>
            <div>
                <a href="{{ route('rendez-vous.edit', $rendezVous) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Modifier
                </a>
                <a href="{{ route('rendez-vous.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Informations du rendez-vous</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Patient</p>
                        <p class="mt-1">
                            <a href="{{ route('patients.show', $rendezVous->patient) }}" class="text-blue-600 hover:text-blue-900">
                                {{ $rendezVous->patient->nom }} {{ $rendezVous->patient->prenom }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date et heure</p>
                        <p class="mt-1">{{ $rendezVous->date_heure->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Motif</p>
                        <p class="mt-1">{{ $rendezVous->motif }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Statut</p>
                        <p class="mt-1">
                            @if ($rendezVous->confirme)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Confirmé
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    En attente
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Consultation associée</h3>
                @if ($rendezVous->consultation)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Salle</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Début</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Fin</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-4 px-6">{{ $rendezVous->consultation->salle->nom }}</td>
                                    <td class="py-4 px-6">{{ $rendezVous->consultation->heure_debut->format('d/m/Y H:i') }}</td>
                                    <td class="py-4 px-6">{{ $rendezVous->consultation->heure_fin ? $rendezVous->consultation->heure_fin->format('d/m/Y H:i') : 'Non définie' }}</td>
                                    <td class="py-4 px-6">{{ $rendezVous->consultation->type }}</td>
                                    <td class="py-4 px-6">{{ $rendezVous->consultation->statut }}</td>
                                    <td class="py-4 px-6">
                                        <a href="{{ route('consultations.show', $rendezVous->consultation) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="flex justify-between items-center">
                        <p class="text-gray-500">Aucune consultation associée à ce rendez-vous.</p>
                        @if ($rendezVous->confirme)
                            <a href="{{ route('consultations.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Planifier une consultation
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
