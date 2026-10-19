<!DOCTYPE html>
<html lang="es" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KROMA® — Digital Product & UI/UX Archive')</title>

    <!-- Sistema Tipográfico de Agencia: Plus Jakarta Sans + Instrument Serif + JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Instrument Serif"', 'serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        obsidian: '#09090B',
                        surface: '#111114',
                    }
                }
            }
        }
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #09090B;
            background-image: 
                radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.04) 0%, transparent 60%),
                linear-gradient(to right, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 100% 100%, 64px 64px, 64px 64px;
        }
    </style>
</head>
<body class="text-zinc-100 font-sans antialiased min-h-screen flex flex-col selection:bg-white selection:text-zinc-950">

    <!-- Navbar Editorial -->
    @include('partials.navbar')

    <!-- Alertas Globales en Pantalla -->
    <div class="max-w-7xl mx-auto w-full px-6 sm:px-10 pt-6">
        @include('partials.alerts')
    </div>

    <!-- Contenido Principal -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-6 sm:px-10 py-10">
        @yield('content')
    </main>

    <!-- Footer Editorial -->
    <footer class="border-t border-white/[0.08] bg-obsidian/90 mt-24">
        <div class="max-w-7xl mx-auto px-6 sm:px-10 py-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span class="font-mono text-xs uppercase tracking-widest text-zinc-400">
                    KROMA® STUDIO — DIGITAL PRODUCT & UI/UX PORTFOLIO
                </span>
            </div>
            <div class="font-mono text-xs text-zinc-500">
                ALL RIGHTS RESERVED · {{ date('Y') }}
            </div>
        </div>
    </footer>

    <!-- Configuración SweetAlert2 Minimalista (Éxito, Error y Validaciones) -->
    <script>
        const swalStudioConfig = {
            background: '#111114',
            color: '#f4f4f5',
            customClass: {
                popup: 'border border-white/10 rounded-2xl',
            }
        };

        @if(session('success'))
            Swal.fire({
                ...swalStudioConfig,
                title: 'Operación completada',
                text: @json(session('success')),
                icon: 'success',
                confirmButtonColor: '#ffffff',
                confirmButtonText: '<span style="color:#09090b;font-weight:700;">Aceptar</span>'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                ...swalStudioConfig,
                title: 'Atención',
                text: @json(session('error')),
                icon: 'error',
                confirmButtonColor: '#f43f5e',
                confirmButtonText: 'Cerrar'
            });
        @endif

        @if($errors->any())
            Swal.fire({
                ...swalStudioConfig,
                title: 'Revisa los campos del formulario',
                html: `<ul style="text-align:left; font-size:13px; line-height:1.7; color:#fda4af; list-style:disc; padding-left:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>`,
                icon: 'warning',
                confirmButtonColor: '#ffffff',
                confirmButtonText: '<span style="color:#09090b;font-weight:700;">Corregir datos</span>'
            });
        @endif

        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    ...swalStudioConfig,
                    title: '¿Confirmar eliminación?',
                    text: 'Esta acción eliminará el registro de forma permanente.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f43f5e',
                    cancelButtonColor: '#27272a',
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