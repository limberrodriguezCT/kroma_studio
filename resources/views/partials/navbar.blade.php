<header class="sticky top-0 z-50 backdrop-blur-md bg-slate-950/80 border-b border-slate-800/80">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <!-- Logo del Estudio -->
        <a href="{{ route('projects.index') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center font-extrabold text-white shadow-lg shadow-indigo-500/20">
                K
            </div>
            <div>
                <span class="font-bold text-lg tracking-tight text-white">Kroma Studio</span>
                <span class="text-xs block text-slate-400 -mt-1">UI/UX Case Studies</span>
            </div>
        </a>

        <!-- Navegación y Estado de Autenticación (Laravel Breeze) -->
        <nav class="flex items-center gap-4">
            <a href="{{ route('projects.index') }}" class="text-sm font-medium text-slate-300 hover:text-white transition">
                Catálogo de Casos
            </a>

            @auth
                <!-- Botón para crear caso de estudio -->
                <a href="{{ route('projects.create') }}"
                   class="inline-flex items-center gap-2 bg-white text-slate-950 hover:bg-indigo-50 font-semibold text-sm px-4 py-2.5 rounded-xl transition shadow-sm">
                    <span>+ Nuevo Caso</span>
                </a>

                <!-- Usuario autenticado y botón de Salir (Ruta logout de Breeze) -->
                <div class="flex items-center gap-3 pl-3 border-l border-slate-800">
                    <a href="{{ route('profile.edit') }}" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300">
                        {{ Auth::user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs font-medium text-slate-400 hover:text-rose-400 transition">
                            Salir
                        </button>
                    </form>
                </div>
            @else
                <!-- Botones si no ha iniciado sesión (Rutas login y register de Breeze) -->
                <div class="flex items-center gap-3 pl-3 border-l border-slate-800">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition">
                        Iniciar sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm px-4 py-2 rounded-xl transition">
                            Registrarse
                        </a>
                    @endif
                </div>
            @endauth
        </nav>
    </div>
</header>