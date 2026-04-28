<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Liste des Patients</h2>
            <a href="{{ route('patients.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm"> +
                Ajouter</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 border-b">Nom</th>
                            <th class="p-3 border-b">Prénom</th>
                            <th class="p-3 border-b">Téléphone</th>
                            <th class="p-3 border-b">Antécédents</th>
                            <th class="p-3 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border-b">{{ $patient->nom }}</td>
                                <td class="p-3 border-b">{{ $patient->prenom }}</td>
                                <td class="p-3 border-b">{{ $patient->telephone }}</td>
                                <td class="p-3 border-b">
                                    <span class="text-gray-700">{{ $patient->antecedents }}</span>
                                </td>
                                <td class="p-3 border-b">
                                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                        onsubmit="return confirm('Supprimer ce patient ?');">
                                        @csrf
                                        @method('DELETE') <button type="submit"
                                            class="text-red-600 hover:underline font-bold">
                                            Supprimer
                                        </button>
                                    </form>
                                    <a href="{{ route('patients.edit', $patient->id) }}"
                                        class="text-blue-600 hover:underline mr-4 font-bold">
                                        Modifier
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>