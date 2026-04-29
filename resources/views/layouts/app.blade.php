<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Force la ligne de soulignement active en med-blue */
        .inline-flex.items-center.px-1.pt-1.border-b-2.border-indigo-400 {
            border-color: #74B3CE !important;
            /* Ton med-blue */
            color: white !important;
        }

        /* Force la couleur du texte des liens non-actifs en blanc */
        nav a {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        nav a:hover {
            color: white !important;
        }
        /* ... tes anciens styles ... */

    /* Force le texte du menu déroulant à être très foncé */
    .block.px-4.py-2.text-sm.leading-5 {
        color: #172A3A !important; /* Ton med-dark */
        background-color: white !important;
    }

    /* Change la couleur au survol pour que ce soit joli */
    .block.px-4.py-2.text-sm.leading-5:hover {
        background-color: #D6F3F4 !important; /* Ton med-light */
        color: #004346 !important; /* Ton med-green */
    }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-med-light">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>