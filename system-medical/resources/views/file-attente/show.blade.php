<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails de la file d\'attente') }}
            </h2>
            <div>
                <a href="{{ route('file-attente.edit', $fileAttente) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Modifier
                </a>
                <a href="{{ route('file-attente.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Informations de la file d'attente</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Patient</p>
                        <p class="mt-1">
                            <a href="{{ route('patients.show', $fileAttente->patient) }}" class="text-blue-600 hover:text-blue-900">
                                {{ $fileAttente->patient->nom }} {{ $fileAttente->patient->prenom }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Consultation</p>
                        <p class="mt-1">
                            <a href="{{ route('consultations.show', $fileAttente->consultation) }}" class="text-blue-600 hover:text-blue-900">
                                {{ $fileAttente->consultation->type }} - {{ $fileAttente->consultation->heure_debut->format('d/m/Y H:i') }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Salle</p>
                        <p class="mt-1">
                            <a href="{{ route('salles.show', $fileAttente->consultation->salle) }}" class="text-blue-600 hover:text-blue-900">
                                {{ $fileAttente->consultation->salle->nom }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Heure d'arrivée</p>
                        <p class="mt-1">{{ $fileAttente->heure_arrivee->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Position</p>
                        <p class="mt-1">{{ $fileAttente->position }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Statut</p>
                        <p class="mt-1">
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
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                @if ($fileAttente->statut === 'en attente')
                    <form action="{{ route('file-attente.update', $fileAttente) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="patient_id" value="{{ $fileAttente->patient_id }}">
                        <input type="hidden" name="consultation_id" value="{{ $fileAttente->consultation_id }}">
                        <input type="hidden" name="heure_arrivee" value="{{ $fileAttente->heure_arrivee->format('Y-m-d\TH:i') }}">
                        <input type="hidden" name="position" value="{{ $fileAttente->position }}">
                        <input type="hidden" name="statut" value="en consultation">
                        <button type="submit" class="bg-blue-500 hover:bg
