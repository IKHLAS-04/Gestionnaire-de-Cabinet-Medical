<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-100 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-bold">Total Patients</h3>
                            <p class="text-3xl font-black">{{ $stats['total'] }}</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="text-lg font-bold mb-4">Derniers ajouts</h3>
                            <ul>
                                @foreach($stats['recents'] as $p)
                                    <li>{{ $p->nom }} {{ $p->prenom }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-bold mb-4">📅 Prochains Rendez-vous</h3>

        @foreach($rdvs as $rdv)
            <div class="flex justify-between items-center border-b py-2">
                <span class="font-bold text-gray-800">
                    {{ substr($rdv->nom, 0, 1) }}. {{ substr($rdv->prenom, 0, 1) }}.
                </span>
                <span class="text-sm text-blue-600">
                    {{ \Carbon\Carbon::parse($rdv->prochain_rdv)->format('d/m H:i') }}
                </span>
                <a href="{{ route('patients.edit', $rdv->id) }}" class="text-xs bg-gray-100 px-2 py-1 rounded">Dossier</a>
            </div>
        @endforeach
    </div>
</x-app-layout>