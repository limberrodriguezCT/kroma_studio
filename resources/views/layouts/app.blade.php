<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Kroma Studio — Agencia UI/UX'))</title>

    <!-- Tipografía UI/UX: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite de Laravel Breeze (Tailwind + Alpine.js) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Respaldo CDN de Tailwind para clases dinámicas al instante -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased selection:bg-indigo-500 selection:text-white min-h-screen flex flex-col">

    <!-- Barra de Navegación integrada con el Login/Logout de Breeze -->
    @include('partials.navbar')

    <!-- Alertas de Sesión y Errores de los FormRequest -->
    <div class="max-w-7xl mx-auto px-6 w-full mt-6">
        @include('partials.alerts')
    </div>

    <!-- Contenido Principal: Soporta @yield('content') y también $slot de Breeze -->
    <main class="flex-grow max-w-7xl mx-auto px-6 py-10 w-full">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800/80 py-8 mt-20 text-center text-sm text-slate-500">
        <p>Kroma Studio UI/UX &copy; {{ date('Y') }} — Arquitectura Laravel MVC + Breeze</p>
    </footer>

</body>
</html>