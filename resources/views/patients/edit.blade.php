<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le patient : {{ $patient->nom }} {{ $patient->prenom }}
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
                        <label>Antécédents médicaux</label>
                        <textarea name="antecedents"
                            class="w-full border-gray-300 rounded-md">{{ $patient->antecedents }}</textarea>
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