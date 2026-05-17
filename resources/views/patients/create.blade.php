<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un nouveau patient
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('patients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nom</label>
                            <input type="text" name="nom" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Prénom</label>
                            <input type="text" name="prenom" class="w-full border-gray-300 rounded-md shadow-sm"
                                required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Téléphone</label>
                        <input type="text" name="telephone" class="w-full border-gray-300 rounded-md shadow-sm"
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Date de naissance</label>
                        <input type="date" name="date_naissance" class="w-full border-gray-300 rounded-md shadow-sm"
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Notes</label>
                        <textarea name="notes" class="w-full border-gray-300 rounded-md shadow-sm" rows="4"></textarea>
                    </div>
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Date du Prochain Rendez-vous</label>
                        <input type="datetime-local" name="prochain_rdv"
                            value="{{ isset($patient) ? $patient->prochain_rdv : '' }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Motif du rendez-vous</label>
                        <input type="text" name="motif" placeholder="Ex: Consultation, Contrôle, Urgence..."
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Prix de la consultation</label>
                        <input type="number" name="prix" step="0.01"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Ex: 300">
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="text-med-light font-bold hover:text-med-blue text-sm bg-med-dark px-3 py-1 rounded shadow w-24 text-center">
                            Enregistrer
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>