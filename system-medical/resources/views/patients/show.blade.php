<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails du patient') }}
            </h2>
            <div>
                <a href="{{ route('patients.edit', $patient) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Modifier
                </a>
                <a href="{{ route('patients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Informations personnelles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nom</p>
                        <p class="mt-1">{{ $patient->nom }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Prénom</p>
                        <p class="mt-1">{{ $patient->prenom }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Téléphone</p>
                        <p class="mt-1">{{ $patient->telephone }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date de naissance</p>
                        <p class="mt-1">{{ $patient->date_naissance->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Rendez-vous</h3>
                @if ($patient->rendezVous->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Date et heure</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Motif</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                    <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($patient->rendezVous as $rendezVous)
                                    <tr>
                                        <td class="py-4 px-6">{{ $rendezVous->date_heure->format('d/m/Y H:i') }}</td>
                                        <td class="py-4 px-6">{{ $rendezVous->motif }}</td>
                                        <td class="py-4 px-6">
                                            @if ($rendezVous->confirme)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Confirmé
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    En attente
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('rendez-vous.show', $rendezVous) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">Aucun rendez-vous trouvé pour ce patient.</p>
                @endif
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">File d'attente</h3>
                @if ($patient->fileAttentes->count() > 0)
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
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($patient->fileAttentes as $fileAttente)
                                    <tr>
                                        <td class="py-4 px-6">{{ $fileAttente->heure_arrivee->format('d/m/Y H:i') }}</td>
                                        <td class="py-4 px-6">{{ $fileAttente->position }}</td>
                                        <td class="py-4 px-6">{{ $fileAttente->statut }}</td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('file-attente.show', $fileAttente) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">Ce patient n'est pas actuellement dans la file d'attente.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
