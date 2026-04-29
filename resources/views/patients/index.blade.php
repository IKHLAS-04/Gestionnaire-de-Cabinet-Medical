<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Liste des Patients</h2>
            <a href="{{ route('patients.create') }}" class="bg-med-blue hover:bg-med-teal text-white px-4 py-2 rounded-md shadow-sm transition"> +
                Ajouter</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-med-green">
                            <th class="p-3 border-b text-center text-white">Nom</th>
                            <th class="p-3 border-b text-center text-white">Prénom</th>
                            <th class="p-3 border-b text-center text-white">Prochain RDV</th>
                            <th class="p-3 border-b text-center text-white">Téléphone</th>
                            <th class="p-3 border-b text-center text-white">Notes</th>
                            <th class="p-3 border-b text-center text-white">Dossiers</th>
                            <th class="p-3 border-b text-center text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border-b">{{ $patient->nom }}</td>
                                <td class="p-3 border-b">{{ $patient->prenom }}</td>
                                <td class="p-3 border-b font-semibold text-blue-700">
                                    {{ $patient->prochain_rdv ? \Carbon\Carbon::parse($patient->prochain_rdv)->format('d/m/Y H:i') : 'Non planifié' }}
                                </td>
                                <td class="p-3 border-b">{{ $patient->telephone }}</td>
                                <td class="p-3 border-b text-sm text-gray-600 italic">
                                    {{ Str::limit($patient->notes, 30) }}
                                </td>

                                <td class="p-3 border-b">
                                    @if($patient->document_path)
                                        <a href="{{ asset('storage/' . $patient->document_path) }}" target="_blank"
                                            class="text-blue-600 hover:underline flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Ouvrir PDF
                                        </a>
                                    @else
                                        <span class="text-gray-400 italic text-sm">Aucun document</span>
                                    @endif
                                </td>

                                <td class="p-3 border-b">
                                    <div class="flex flex-col items-center space-y-2">

                                        <a href="{{ route('patients.edit', $patient->id) }}"
                                            class="text-med-dark font-bold hover:text-med-blue text-sm bg-blue-50 px-3 py-1 rounded w-24 text-center">
                                            Modifier
                                        </a>

                                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                            onsubmit="return confirm('Supprimer ce patient ?');" class="w-24">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-bold text-sm bg-red-50 px-3 py-1 rounded w-full text-center">
                                                Supprimer
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>