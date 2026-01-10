<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Beeaesthetic') }}</title>
        <link rel="icon" href="{{ asset('Images/logo.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Preload hero image for performance -->
        <link rel="preload" as="image" href="{{ asset('Images/magasin2.webp') }}" type="image/webp" fetchpriority="high">
        <link rel="preload" as="image" href="{{ asset('Images/magasin2.jpg') }}" fetchpriority="high">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead

        <!-- Styles pour cacher le widget Google Translate -->
        <style>
            /* Cacher le widget Google Translate par défaut */
            #google_translate_element {
                display: none !important;
            }

            /* Cacher la barre Google Translate en haut */
            .goog-te-banner-frame {
                display: none !important;
            }

            /* Réajuster le body quand Google Translate est actif */
            body {
                top: 0 !important;
            }

            /* Cacher le bouton "Original" de Google */
            .goog-te-combo option:first-child {
                display: none;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Conteneur invisible pour Google Translate -->
        <div id="google_translate_element"></div>

        @inertia
    </body>
</html>
