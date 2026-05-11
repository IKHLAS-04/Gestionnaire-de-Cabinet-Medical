<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="bg-med-blue p-6 rounded-xl shadow-md text-white border-b-4 border-med-teal">
            <h3 class="text-lg font-semibold opacity-80 uppercase tracking-wider">Recettes du Jour</h3>
            <p class="text-5xl font-extrabold mt-2">{{ $appointments->sum('prix') }} DH</p>
        </div>

        <div class="space-y-4">
            @forelse($appointments as $appointment)
                <div class="p-4 bg-white/10 rounded-xl border border-white/20">
                    <p class="text-med-teal font-bold">
                        {{ $appointment->patient->nom }} - {{ $appointment->motif }}
                    </p>
                    <p class="text-sm text-blue-200">
                        Heure : {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('H:i') }}
                    </p>
                </div>
            @empty
                <p class="text-med-teal font-medium italic">Aucun rendez-vous aujourd'hui.</p>
            @endforelse
        </div>
    </div>
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md border-t-4 border-med-green">
        <h3 class="text-lg font-bold mb-4 text-med-dark">📅 Prochains Rendez-vous</h3>

        @foreach($appointments as $rdv)
            <div
                class="flex justify-between items-center border-l-4 border-med-teal bg-med-light/20 mb-3 p-3 rounded-r-lg shadow-sm">
                <div>
                    <span class="font-extrabold text-med-dark uppercase">
                        {{ $rdv->nom }} {{ $rdv->prenom }}
                    </span>
                    <p class="text-xs text-med-teal italic">Consultation planifiée</p>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-sm font-bold text-med-blue">
                        {{ \Carbon\Carbon::parse($rdv->prochain_rdv)->format('d/m H:i') }}
                    </span>

                    <a href="{{ route('patients.show', $rdv->patient_id) }}"
                        class="bg-med-green text-white text-xs px-3 py-1 rounded-full hover:bg-med-dark transition shadow-sm font-bold">
                        Dossier
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>