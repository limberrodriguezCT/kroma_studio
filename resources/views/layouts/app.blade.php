<!DOCTYPE html>
<html lang="es" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kroma Studio — UI/UX Case Studies')</title>

    <!-- Tipografía Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN + Configuración Dark UI -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- SweetAlert2 para alertas elegantes y confirmaciones -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white">

    <!-- Barra de Navegación integrada con Breeze -->
    @include('partials.navbar')

    <!-- Alertas Visuales y Resumen de Errores -->
    <div class="max-w-7xl mx-auto w-full px-6 pt-6">
        @include('partials.alerts')
    </div>

    <!-- Contenido Dinámico Principal -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-8">
        @yield('content')
    </main>

    <!-- Footer Minimalista del Estudio -->
    <footer class="border-t border-slate-900 bg-slate-950/90 py-8 mt-16">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <p>© {{ date('Y') }} Kroma Studio. Proyecto Académico de Arquitectura Backend & UI/UX.</p>
            <p>Desarrollado con Laravel, Eloquent ORM, Breeze & Tailwind CSS</p>
        </div>
    </footer>

    <!-- Sistema de Alertas Interactivas SweetAlert2 (Tema Dark UI) -->
    <script>
        const swalDarkConfig = {
            background: '#0f172a',
            color: '#f8fafc',
        };

        @if(session('success'))
            Swal.fire({
                ...swalDarkConfig,
                title: '¡Operación Exitosa!',
                text: @json(session('success')),
                icon: 'success',
                confirmButtonColor: '#6366f1',
                confirmButtonText: 'Entendido'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                ...swalDarkConfig,
                title: 'Ocurrió un problema',
                text: @json(session('error')),
                icon: 'error',
                confirmButtonColor: '#f43f5e',
                confirmButtonText: 'Cerrar'
            });
        @endif

        // Confirmación elegante para cualquier formulario con la clase .form-delete
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    ...swalDarkConfig,
                    title: '¿Confirmar eliminación?',
                    text: 'Esta acción no se puede deshacer y eliminará el registro de la base de datos.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f43f5e',
                    cancelButtonColor: '#334155',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>