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
                        <label class="block font-medium text-sm text-gray-700">Antécédents médicaux</label>
                        <textarea name="antecedents" class="w-full border-gray-300 rounded-md shadow-sm"
                            rows="4"></textarea>
                    </div>
                    <div class="mt-4">
                        <label>Document Médical (PDF uniquement)</label>
                        <input type="file" name="document" class="w-full">
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="mt-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                            Enregistrer
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>