<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le dossier du patient') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- L'action utilise bien la route update avec l'ID du patient -->
                <form action="{{ route('patients.update', $patient->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Indispensable pour que Laravel comprenne qu'on modifie -->

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nom</label>
                            <input type="text" name="nom" value="{{ $patient->nom }}"
                                class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Prénom</label>
                            <input type="text" name="prenom" value="{{ $patient->prenom }}"
                                class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Téléphone</label>
                        <input type="text" name="telephone" value="{{ $patient->telephone }}"
                            class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                    </div>

                    <!-- Ajout du champ Date de Naissance qui manquait -->
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Date de Naissance</label>
                        <input type="date" name="date_naissance" value="{{ $patient->date_naissance }}"
                            class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Résumé du dossier / Notes</label>
                        <textarea name="notes" class="w-full border-gray-300 rounded-md shadow-sm mt-1"
                            rows="4">{{ $patient->notes }}</textarea>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Date du Prochain Rendez-vous</label>
                        <input type="datetime-local" name="prochain_rdv"
                            value="{{ $patient->prochain_rdv ? \Carbon\Carbon::parse($patient->prochain_rdv)->format('Y-m-d\TH:i') : '' }}"
                            class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Motif du rendez-vous</label>
                        <input type="text" name="motif" value="{{ $patient->appointments->first()->motif ?? '' }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mt-6 flex items-center gap-4">
                        <button type="submit"
                            class="bg-med-dark hover:bg-teal-700 text-white font-bold py-2 px-6 rounded shadow transition duration-150">
                            {{ __('Mettre à jour la fiche') }}
                        </button>

                        <a href="{{ route('patients.index') }}" class="text-gray-600 hover:underline">Annuler</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>