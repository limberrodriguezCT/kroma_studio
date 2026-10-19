@extends('layouts.app')

@section('title', 'Acceso al Estudio — KROMA®')

@section('content')
    <div class="min-h-[72vh] flex items-center justify-center py-8">
        <div class="w-full max-w-md">
            <div class="mb-8">
                <span class="font-mono text-[11px] uppercase tracking-widest text-zinc-500 block mb-3">
                    [STUDIO ACCESS — PORTAL INTERNO]
                </span>
                <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight leading-none">
                    Iniciar <span class="font-serif italic font-normal text-zinc-300">sesión.</span>
                </h1>
                <p class="mt-3 text-sm text-zinc-400">
                    Accede al panel creativo para publicar casos de estudio, gestionar entregables y administrar el portafolio.
                </p>
            </div>

            <div class="rounded-2xl border border-white/[0.08] bg-surface p-7 sm:p-9 shadow-2xl">
                <form method="POST" action="{{ route('login') }}" novalidate class="space-y-6">
                    @csrf

                    <!-- Correo Electrónico -->
                    <div>
                        <label for="email" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                            Correo Corporativo *
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" autofocus autocomplete="username"
                               placeholder="admin@kromastudio.com"
                               class="w-full rounded-xl border {{ $errors->has('email') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3 text-sm text-white placeholder-zinc-600 focus:border-white focus:outline-none transition">
                        @error('email')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                            Contraseña *
                        </label>
                        <input id="password" type="password" name="password" autocomplete="current-password"
                               placeholder="••••••••••••"
                               class="w-full rounded-xl border {{ $errors->has('password') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3 text-sm text-white placeholder-zinc-600 focus:border-white focus:outline-none transition">
                        @error('password')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Recordar Sesión y Autocompletar -->
                    <div class="flex items-center justify-between pt-1">
                        <label for="remember_me" class="inline-flex items-center gap-2.5 cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember"
                                   class="w-4 h-4 rounded border-white/20 bg-obsidian text-white focus:ring-0">
                            <span class="text-xs text-zinc-400">Mantener sesión activa</span>
                        </label>

                        <button type="button"
                                onclick="document.getElementById('email').value='admin@kromastudio.com'; document.getElementById('password').value='password123';"
                                class="font-mono text-[11px] text-zinc-400 hover:text-white underline underline-offset-4 transition">
                            Autocompletar Demo
                        </button>
                    </div>

                    <button type="submit"
                            class="w-full rounded-full bg-zinc-100 hover:bg-white text-zinc-950 font-bold text-xs uppercase tracking-wider py-3.5 transition">
                        Entrar al Estudio →
                    </button>
                </form>

                @if (Route::has('register'))
                    <div class="mt-6 pt-6 border-t border-white/[0.06] text-center">
                        <p class="text-xs text-zinc-500">
                            ¿Eres nuevo diseñador en el equipo?
                            <a href="{{ route('register') }}" class="text-zinc-200 font-semibold hover:underline ml-1">
                                Crear cuenta de autor
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection