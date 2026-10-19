<header class="sticky top-0 z-50 backdrop-blur-xl bg-obsidian/80 border-b border-white/[0.08]">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 h-20 flex items-center justify-between">
        <!-- Identidad tipográfica de estudio (Sin gradientes genéricos) -->
        <a href="{{ route('projects.index') }}" class="flex items-center gap-4 group">
            <div class="w-9 h-9 rounded-lg bg-zinc-100 text-zinc-950 flex items-center justify-center font-black text-base tracking-tighter transition duration-300 group-hover:rotate-6">
                K®
            </div>
            <div class="flex flex-col">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-base tracking-tight text-white">Kroma Studio</span>
                    <span class="hidden sm:inline-block font-mono text-[10px] uppercase tracking-widest px-2 py-0.5 rounded bg-white/[0.06] text-zinc-400 border border-white/[0.06]">
                        Index v2.6
                    </span>
                </div>
                <span class="font-mono text-[11px] text-zinc-500">Digital Product & Design Archive</span>
            </div>
        </a>

        <!-- Navegación y Estado de Autenticación (Laravel Breeze) -->
        <nav class="flex items-center gap-6">
            <a href="{{ route('projects.index') }}"
               class="text-xs font-mono uppercase tracking-wider text-zinc-400 hover:text-white transition">
                [01] Catálogo
            </a>

            @auth
                <a href="{{ route('projects.create') }}"
                   class="inline-flex items-center gap-2 bg-zinc-100 hover:bg-white text-zinc-950 font-semibold text-xs px-4 py-2.5 rounded-full transition">
                    <span>+ Publicar Caso</span>
                </a>

                <div class="flex items-center gap-4 pl-4 border-l border-white/10">
                    <a href="{{ route('profile.edit') }}" class="font-mono text-xs text-zinc-300 hover:text-white transition">
                        {{ Auth::user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-mono text-xs uppercase tracking-wider text-zinc-500 hover:text-rose-400 transition">
                            Salir ↗
                        </button>
                    </form>
                </div>
            @else
                <div class="flex items-center gap-3 pl-4 border-l border-white/10">
                    <a href="{{ route('login') }}"
                       class="text-xs font-mono uppercase tracking-wider text-zinc-300 hover:text-white px-3 py-2 transition">
                        Acceso
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="bg-zinc-100 hover:bg-white text-zinc-950 font-semibold text-xs px-4 py-2.5 rounded-full transition">
                            Registrarse
                        </a>
                    @endif
                </div>
            @endauth
        </nav>
    </div>
</header>