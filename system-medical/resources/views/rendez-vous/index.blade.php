<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rendez-vous') }}
            </h2>
            <a href="{{ route('rendez-vous.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Ajouter un rendez-vous
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
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Date et heure</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Motif</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                            <th class="py-3 px-6 text-left bg-gray-100 font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($rendezVous as $rdv)
                            <tr>
                                <td class="py-4 px-6">{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</td>
                                <td class="py-4 px-6">{{ $rdv->date_heure->format('d/m/Y H:i') }}</td>
                                <td class="py-4 px-6">{{ $rdv->motif }}</td>
                                <td class="py-4 px-6">
                                    @if ($rdv->confirme)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Confirmé
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 flex space-x-2">
                                    <a href="{{ route('rendez-vous.show', $rdv) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                    <a href="{{ route('rendez-vous.edit', $rdv) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                                    <form action="{{ route('rendez-vous.destroy', $rdv) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 px-6 text-center text-gray-500">Aucun rendez-vous trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $rendezVous->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
