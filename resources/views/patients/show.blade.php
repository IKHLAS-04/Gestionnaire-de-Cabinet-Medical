<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-med-dark leading-tight">
            Dossier Médical : {{ $patient->nom }} {{ $patient->prenom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-8 border-med-green">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-med-blue border-b pb-2">Informations Personnelles</h3>
                            <p><strong>Téléphone :</strong> {{ $patient->telephone }}</p>
                            <p><strong>Prochain RDV :</strong>
                                <span class="text-med-teal font-bold">
                                    {{ $patient->prochain_rdv ? \Carbon\Carbon::parse($patient->prochain_rdv)->format('d/m/Y H:i') : 'Non planifié' }}
                                </span>
                            </p>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-med-blue border-b pb-2">Documents attachés</h3>
                            @if($patient->document_path)
                                <a href="{{ asset('storage/' . $patient->document_path) }}" target="_blank"
                                    class="inline-flex items-center text-blue-600 hover:underline">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Consulter le dossier PDF
                                </a>
                            @else
                                <p class="text-gray-400 italic">Aucun document numérisé.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-med-blue border-b pb-2">Notes & Antécédents</h3>
                        <div class="mt-4 p-4 bg-med-light/20 rounded-lg italic text-gray-700">
                            {{ $patient->notes ?: 'Aucune note enregistrée.' }}
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-4">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-med-teal hover:text-med-green font-bold transition">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Retour
                        </a>

                        <a href="{{ route('patients.edit', $patient->id) }}"
                            class="bg-med-blue text-white px-4 py-2 rounded shadow font-bold hover:bg-med-teal">
                            Modifier le dossier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>