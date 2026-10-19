@extends('layouts.app')

@section('title', 'Registro de Autor — KROMA®')

@section('content')
    <div class="min-h-[75vh] flex items-center justify-center py-8">
        <div class="w-full max-w-md">
            <div class="mb-8">
                <span class="font-mono text-[11px] uppercase tracking-widest text-zinc-500 block mb-3">
                    [NEW CREATIVE ACCOUNT]
                </span>
                <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight leading-none">
                    Crear <span class="font-serif italic font-normal text-zinc-300">credencial.</span>
                </h1>
                <p class="mt-3 text-sm text-zinc-400">
                    Regístrate como diseñador en Kroma Studio para publicar y documentar tus propios casos de estudio.
                </p>
            </div>

            <div class="rounded-2xl border border-white/[0.08] bg-surface p-7 sm:p-9 shadow-2xl">
                <form method="POST" action="{{ route('register') }}" novalidate class="space-y-5">
                    @csrf

                    <!-- Nombre Completo -->
                    <div>
                        <label for="name" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                            Nombre y Apellido / Rol *
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus autocomplete="name"
                               placeholder="Ej. Paola — Product Designer"
                               class="w-full rounded-xl border {{ $errors->has('name') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3 text-sm text-white placeholder-zinc-600 focus:border-white focus:outline-none transition">
                        @error('name')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Correo Electrónico -->
                    <div>
                        <label for="email" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                            Correo Electrónico *
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username"
                               placeholder="paola@kromastudio.com"
                               class="w-full rounded-xl border {{ $errors->has('email') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3 text-sm text-white placeholder-zinc-600 focus:border-white focus:outline-none transition">
                        @error('email')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                            Contraseña (Mínimo 8 caracteres) *
                        </label>
                        <input id="password" type="password" name="password" autocomplete="new-password"
                               placeholder="••••••••••••"
                               class="w-full rounded-xl border {{ $errors->has('password') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3 text-sm text-white placeholder-zinc-600 focus:border-white focus:outline-none transition">
                        @error('password')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div>
                        <label for="password_confirmation" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                            Confirmar Contraseña *
                        </label>
                        <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password"
                               placeholder="Repite tu contraseña"
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-4 py-3 text-sm text-white placeholder-zinc-600 focus:border-white focus:outline-none transition">
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                                class="w-full rounded-full bg-zinc-100 hover:bg-white text-zinc-950 font-bold text-xs uppercase tracking-wider py-3.5 transition">
                            Registrar Cuenta en el Estudio →
                        </button>
                    </div>
                </form>

                <div class="mt-6 pt-6 border-t border-white/[0.06] text-center">
                    <p class="text-xs text-zinc-500">
                        ¿Ya tienes una credencial activa?
                        <a href="{{ route('login') }}" class="text-zinc-200 font-semibold hover:underline ml-1">
                            Iniciar sesión
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection