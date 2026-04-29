<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DocAgenda</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="relative flex items-center justify-center min-h-screen bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('images/1.jpg') }}');">

        <div class="absolute inset-0 bg-black/30"></div>

        <main class="relative z-10 w-full max-w-lg mx-4">
            <div
                class="bg-white/20 backdrop-blur-xl border border-white/30 shadow-2xl rounded-3xl p-8 lg:p-12 text-center">

                <div class="flex justify-center mb-6">
                    <div
                        class="bg-med-green p-4 rounded-2xl shadow-lg transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                            <circle cx="12" cy="15" r="1" fill="currentColor"></circle>
                        </svg>
                    </div>
                </div>

                <h1 class="text-4xl font-black text-white mb-2 drop-shadow-md tracking-tight">
                    DocAgenda
                </h1>
                <p class="text-slate-100 text-lg mb-10 font-medium opacity-90">
                    Gestionnaire de Cabinet Médical.
                </p>

                <div class="flex flex-col gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="w-full bg-med-blue text-white py-4 rounded-xl font-bold shadow-lg hover:bg-med-teal transform hover:-translate-y-1 transition-all duration-200">
                                Accéder au Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full bg-med-green text-white py-4 rounded-xl font-bold shadow-lg hover:bg-med-teal transform hover:-translate-y-1 transition-all duration-200">
                                Se connecter
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="w-full bg-white/10 text-white border border-white/40 py-4 rounded-xl font-bold hover:bg-white/20 backdrop-blur-sm transition-all">
                                    Créer un compte
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <p class="mt-10 text-white/50 text-xs font-medium tracking-widest uppercase">
                    &copy; 2026 Projet PHP - Ikhlas LEMROUNI
                </p>
            </div>
        </main>
    </div>
</body>

</html>