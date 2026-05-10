<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DocAgenda - Accueil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="relative flex items-center justify-center min-h-screen bg-cover bg-center bg-no-repeat" 
         style="background-image: url('{{ asset('images/1.jpg') }}');">
        
        <div class="absolute inset-0 bg-slate-900/60"></div>

        <main class="relative z-10 w-full max-w-md mx-4 p-10 bg-white/10 backdrop-blur-xl border border-white/20 rounded-[2rem] shadow-2xl text-center">
            
            <div class="flex justify-center mb-8">
                <div class="bg-[#004346] p-4 rounded-2xl shadow-lg border border-white/10">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>

            <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-sm">DocAgenda</h1>
            <p class="text-blue-100/70 mb-10 font-medium">Gestionnaire de Cabinet Médical</p>

            <div class="flex flex-col gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="w-full bg-[#004346] text-white py-3.5 rounded-xl font-bold shadow-lg hover:bg-med-teal transition-all duration-300 transform hover:-translate-y-1">
                            Accéder au Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="w-full bg-[#004346] text-white py-3.5 rounded-xl font-bold shadow-lg hover:bg-[#005a5e] transition-all duration-300 transform hover:-translate-y-1">
                            Se connecter
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="w-full bg-white/5 text-white border border-white/20 py-3.5 rounded-xl font-bold hover:bg-white/10 transition-all duration-300">
                                Créer un compte
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <footer class="mt-12 text-white/30 text-[10px] tracking-[0.2em] uppercase font-bold">
                &copy; 2026 ENSA AGADIR &bull; IKHLAS LEMROUNI
            </footer>
        </main>
    </div>
</body>
</html>