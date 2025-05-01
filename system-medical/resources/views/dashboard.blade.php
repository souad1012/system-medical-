<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h1 class="text-2xl font-bold mb-6">Système de Gestion Médicale</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-blue-50 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Patients</h2>
                    <p class="text-gray-600 mb-4">Gérer les informations des patients</p>
                    <a href="{{ route('patients.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Voir les patients
                    </a>
                </div>
                
                <div class="bg-green-50 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Rendez-vous</h2>
                    <p class="text-gray-600 mb-4">Gérer les rendez-vous des patients</p>
                    <a href="{{ route('rendez-vous.index') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Voir les rendez-vous
                    </a>
                </div>
                
                <div class="bg-purple-50 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Consultations</h2>
                    <p class="text-gray-600 mb-4">Gérer les consultations médicales</p>
                    <a href="{{ route('consultations.index') }}" class="inline-block bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">
                        Voir les consultations
                    </a>
                </div>
                
                <div class="bg-yellow-50 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">File d'attente</h2>
                    <p class="text-gray-600 mb-4">Gérer la file d'attente des patients</p>
                    <a href="{{ route('file-attente.index') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                        Voir la file d'attente
                    </a>
                </div>
                
                <div class="bg-red-50 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Salles</h2>
                    <p class="text-gray-600 mb-4">Gérer les salles de consultation</p>
                    <a href="{{ route('salles.index') }}" class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Voir les salles
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
