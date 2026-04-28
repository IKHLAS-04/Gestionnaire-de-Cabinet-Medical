<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le dossier de : {{ $patient->nom }} {{ $patient->prenom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label>Nom</label>
                            <input type="text" name="nom" value="{{ $patient->nom }}"
                                class="w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label>Prénom</label>
                            <input type="text" name="prenom" value="{{ $patient->prenom }}"
                                class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label>Téléphone</label>
                        <input type="text" name="telephone" value="{{ $patient->telephone }}"
                            class="w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Résumé du dossier / Notes</label>
                        <textarea name="antecedents" class="w-full border-gray-300 rounded-md shadow-sm mt-1"
                            rows="4">{{ $patient->antecedents }}</textarea>
                    </div>

                    <div class="mt-6 border-t pt-4">
                        <label class="block font-medium text-sm text-gray-700">Mettre à jour le document PDF
                            (Optionnel)</label>

                        <input type="file" name="document"
                            class="w-full border-gray-300 rounded-md shadow-sm mt-1 @error('document') border-red-500 @enderror">

                        @error('document')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror

                        @if($patient->document_path)
                            <div class="flex items-center mt-2 p-2 bg-gray-50 rounded">
                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z">
                                    </path>
                                </svg>
                                <p class="text-xs text-gray-500">
                                    Fichier actuel : <span
                                        class="font-semibold">{{ basename($patient->document_path) }}</span>
                                </p>
                            </div>
                        @endif
                    </div>

                    <button type="submit"
                        class="mt-6 bg-blue-600 hover:bg-lightblue-700 text-black font-bold py-2 px-4 rounded shadow">
                        Mettre à jour la fiche
                    </button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>