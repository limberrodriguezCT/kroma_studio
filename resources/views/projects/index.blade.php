@extends('layouts.app')

@section('title', 'Kroma Studio — Portafolio & Casos de Estudio UI/UX')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden rounded-3xl border border-slate-800/80 bg-gradient-to-b from-slate-900/90 to-slate-950 p-8 sm:p-12 mb-10 shadow-2xl">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 px-3.5 py-1 text-xs font-semibold text-indigo-300 mb-4">
                <span class="h-2 w-2 rounded-full bg-indigo-400 animate-pulse"></span>
                Agencia de Diseño de Producto Digital & Ingeniería
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Casos de estudio donde el <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400">diseño UI/UX</span> impulsa métricas reales.
            </h1>
            <p class="mt-4 text-slate-400 text-base sm:text-lg leading-relaxed">
                Explora nuestra arquitectura de productos digitales, sistemas de diseño y experiencias interactivas conectadas mediante bases de datos relacionales.
            </p>
        </div>
    </section>

    <!-- Barra de Filtros por Categoría (RF-01) -->
    <section class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-2">
            @php
                $currentCategory = request()->query('category');
            @endphp

            <a href="{{ route('projects.index') }}"
               class="px-4 py-2 rounded-xl text-xs font-semibold transition border {{ !$currentCategory ? 'bg-white text-slate-950 border-white shadow-sm' : 'bg-slate-900/80 text-slate-300 border-slate-800 hover:border-slate-700 hover:text-white' }}">
                Todos los Casos ({{ $categories->sum('projects_count') }})
            </a>

            @foreach ($categories as $category)
                <a href="{{ route('projects.index', ['category' => $category->slug]) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold transition border {{ $currentCategory === $category->slug ? 'bg-slate-800 text-white border-slate-600 shadow-sm' : 'bg-slate-900/60 text-slate-400 border-slate-800/80 hover:border-slate-700 hover:text-slate-200' }}">
                    <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $category->color_hex }}"></span>
                    <span>{{ $category->name }}</span>
                    <span class="text-[11px] text-slate-500">({{ $category->projects_count }})</span>
                </a>
            @endforeach
        </div>

        @auth
            <a href="{{ route('projects.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 px-4 py-2.5 text-xs font-bold text-white transition shadow-lg shadow-indigo-600/20">
                <span>+ Publicar Caso de Estudio</span>
            </a>
        @endauth
    </section>

    <!-- Galería Bento de Casos de Estudio -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse ($projects as $project)
            <article class="group relative rounded-3xl border border-slate-800/90 bg-slate-900/50 overflow-hidden flex flex-col justify-between transition duration-300 hover:border-slate-700 hover:bg-slate-900/80 hover:shadow-2xl hover:shadow-indigo-950/20">
                <div>
                    <!-- Imagen de Portada con Badges Flotantes -->
                    <div class="relative h-64 sm:h-72 w-full overflow-hidden bg-slate-950">
                        <img src="{{ $project->cover_image }}"
                             alt="{{ $project->title }}"
                             class="h-full w-full object-cover object-center transition duration-500 group-hover:scale-105 opacity-90 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>

                        <!-- Etiqueta Dinámica con Color Hexadecimal desde la BD -->
                        <div class="absolute top-4 left-4 flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold text-white backdrop-blur-md border border-white/15 shadow-sm"
                                  style="background-color: {{ $project->category->color_hex }}CC;">
                                {{ $project->category->name }}
                            </span>

                            @if ($project->is_featured)
                                <span class="inline-flex items-center gap-1 rounded-full bg-amber-500/20 border border-amber-400/40 backdrop-blur-md px-3 py-1 text-xs font-bold text-amber-300">
                                    ★ Destacado
                                </span>
                            @endif
                        </div>

                        <!-- Cliente Corporativo -->
                        <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                @if ($project->client->logo_url)
                                    <img src="{{ $project->client->logo_url }}" alt="{{ $project->client->company_name }}" class="w-7 h-7 rounded-full object-cover border border-slate-700">
                                @endif
                                <span class="text-xs font-semibold text-slate-200">
                                    {{ $project->client->company_name }} · <span class="text-slate-400">{{ $project->client->country }}</span>
                                </span>
                            </div>
                            <span class="text-[11px] font-medium text-slate-400">
                                {{ $project->published_at->format('M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Cuerpo de la Tarjeta -->
                    <div class="p-6 sm:p-7">
                        <h2 class="text-xl sm:text-2xl font-bold text-white group-hover:text-indigo-400 transition leading-snug">
                            <a href="{{ route('projects.show', $project) }}">
                                {{ $project->title }}
                            </a>
                        </h2>
                        <p class="mt-3 text-sm text-slate-400 line-clamp-3 leading-relaxed">
                            {{ $project->summary }}
                        </p>
                    </div>
                </div>

                <!-- Pie de Tarjeta y Acciones Rápidas -->
                <div class="px-6 sm:px-7 pb-6 pt-4 border-t border-slate-800/70 flex items-center justify-between">
                    <a href="{{ route('projects.show', $project) }}"
                       class="inline-flex items-center gap-2 text-xs font-bold text-indigo-400 hover:text-indigo-300 transition">
                        <span>Explorar Caso de Estudio</span>
                        <span class="transition group-hover:translate-x-1">→</span>
                    </a>

                    @auth
                        <div class="flex items-center gap-2">
                            <a href="{{ route('projects.edit', $project) }}"
                               class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-semibold text-slate-200 transition">
                                Editar
                            </a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="form-delete inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1.5 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/30 text-xs font-semibold text-rose-400 transition">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </article>
        @empty
            <!-- Estado Vacío (RNF-03) -->
            <div class="col-span-full rounded-3xl border border-dashed border-slate-800 bg-slate-900/30 p-12 text-center">
                <p class="text-lg font-bold text-white">No se encontraron casos de estudio en esta categoría</p>
                <p class="mt-1 text-sm text-slate-400">Prueba seleccionando otro filtro o publica un nuevo proyecto en el portafolio.</p>
                <a href="{{ route('projects.index') }}" class="mt-5 inline-block rounded-xl bg-slate-800 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-700 transition">
                    Ver todo el catálogo
                </a>
            </div>
        @endforelse
    </section>
@endsection