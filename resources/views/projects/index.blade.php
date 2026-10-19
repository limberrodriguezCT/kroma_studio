@extends('layouts.app')

@section('title', 'KROMA® — Portafolio & Casos de Estudio UI/UX')

@section('content')
    <!-- Cabecera Editorial de Agencia (Sin textos técnicos de BD) -->
    <section class="pb-12 mb-10 border-b border-white/[0.08]">
        <div class="flex items-center gap-3 font-mono text-xs uppercase tracking-widest text-zinc-500 mb-6">
            <span>[SELECTED WORKS — {{ date('Y') }}]</span>
            <span>—</span>
            <span>DIGITAL PRODUCT DESIGN & ENGINEERING</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end">
            <div class="lg:col-span-8">
                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-bold tracking-tight text-white leading-[1.03]">
                    Diseñamos productos digitales donde la <span class="font-serif italic font-normal text-zinc-300">claridad visual</span> impulsa resultados.
                </h1>
            </div>
            <div class="lg:col-span-4 lg:border-l lg:border-white/[0.08] lg:pl-8">
                <p class="text-sm text-zinc-400 leading-relaxed">
                    Estudio independiente especializado en investigación UX, sistemas de diseño escalables, dirección de arte e interfaces de alta conversión para startups globales.
                </p>
            </div>
        </div>
    </section>

    <!-- Barra de Filtros por Disciplina -->
    <section class="mb-12 flex flex-wrap items-center justify-between gap-4">
        @php
            $currentCategory = request()->query('category');
        @endphp

        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('projects.index') }}"
               class="px-4 py-2 rounded-full text-xs font-medium transition border {{ !$currentCategory ? 'bg-zinc-100 text-zinc-950 border-zinc-100 font-semibold' : 'bg-surface text-zinc-400 border-white/[0.08] hover:border-white/20 hover:text-white' }}">
                Todos los proyectos
            </a>

            @foreach ($categories as $category)
                <a href="{{ route('projects.index', ['category' => $category->slug]) }}"
                   class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full text-xs font-medium transition border {{ $currentCategory === $category->slug ? 'bg-zinc-100 text-zinc-950 border-zinc-100 font-semibold' : 'bg-surface text-zinc-400 border-white/[0.08] hover:border-white/20 hover:text-white' }}">
                    <span class="w-2 h-2 rounded-full" style="background-color: {{ $category->color_hex }}"></span>
                    <span>{{ $category->name }}</span>
                </a>
            @endforeach
        </div>

        @auth
            <a href="{{ route('projects.create') }}"
               class="inline-flex items-center gap-2 rounded-full bg-zinc-100 hover:bg-white text-zinc-950 px-5 py-2.5 text-xs font-bold transition shadow-sm">
                <span>+ Publicar Caso de Estudio</span>
            </a>
        @endauth
    </section>

    <!-- Grilla Editorial de Casos de Estudio -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-14">
        @forelse ($projects as $index => $project)
            <article class="group flex flex-col justify-between">
                <div>
                    <!-- Metadatos Superiores de la Tarjeta -->
                    <div class="flex items-center justify-between font-mono text-xs text-zinc-400 mb-3 pb-2 border-b border-white/[0.08]">
                        <div class="flex items-center gap-2.5">
                            <span class="text-zinc-600">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="text-zinc-700">/</span>
                            <span class="font-medium text-zinc-200 uppercase tracking-wider">{{ $project->client->company_name }}</span>
                            <span class="text-zinc-600">·</span>
                            <span class="text-zinc-500">{{ $project->client->country }}</span>
                        </div>
                        <span class="text-zinc-500">{{ $project->published_at->format('M Y') }}</span>
                    </div>

                    <!-- Marco de Imagen Limpio con Hover Editorial -->
                    <a href="{{ route('projects.show', $project) }}"
                       class="block relative aspect-[16/10] w-full overflow-hidden rounded-2xl bg-surface border border-white/[0.08]">
                        <img src="{{ $project->cover_image }}"
                             alt="{{ $project->title }}"
                             class="h-full w-full object-cover object-center transition duration-700 ease-out group-hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

                        @if ($project->is_featured)
                            <div class="absolute top-4 right-4 rounded-full bg-obsidian/80 backdrop-blur-md border border-white/15 px-3 py-1 font-mono text-[10px] uppercase tracking-widest text-amber-300">
                                ★ Selección Destacada
                            </div>
                        @endif

                        <div class="absolute bottom-4 right-4 translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition duration-300">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-white text-zinc-950 px-4 py-2 text-xs font-bold shadow-xl">
                                Ver Caso de Estudio ↗
                            </span>
                        </div>
                    </a>

                    <!-- Información Tipográfica Debajo de la Imagen -->
                    <div class="mt-5">
                        <div class="flex items-center gap-2 mb-2.5">
                            <span class="w-2 h-2 rounded-full" style="background-color: {{ $project->category->color_hex }}"></span>
                            <span class="font-mono text-xs uppercase tracking-wider" style="color: {{ $project->category->color_hex }}">
                                {{ $project->category->name }}
                            </span>
                        </div>

                        <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight group-hover:text-zinc-300 transition leading-snug">
                            <a href="{{ route('projects.show', $project) }}">
                                {{ $project->title }}
                            </a>
                        </h2>

                        <p class="mt-2.5 text-sm text-zinc-400 line-clamp-2 leading-relaxed">
                            {{ $project->summary }}
                        </p>
                    </div>
                </div>

                <!-- Barra Inferior de Acciones -->
                <div class="mt-5 pt-4 border-t border-white/[0.06] flex items-center justify-between">
                    <a href="{{ route('projects.show', $project) }}"
                       class="font-mono text-xs uppercase tracking-wider text-zinc-300 hover:text-white inline-flex items-center gap-2 transition">
                        <span>Explorar caso completo</span>
                        <span class="transition-transform group-hover:translate-x-1">→</span>
                    </a>

                    @auth
                        <div class="flex items-center gap-2">
                            <a href="{{ route('projects.edit', $project) }}"
                               class="rounded-full border border-white/10 bg-surface hover:bg-white hover:text-zinc-950 px-3.5 py-1 text-xs font-medium text-zinc-300 transition">
                                Editar
                            </a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="form-delete inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="rounded-full border border-rose-500/25 bg-rose-500/10 hover:bg-rose-500/20 px-3.5 py-1 text-xs font-medium text-rose-300 transition">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-white/15 bg-surface/40 p-16 text-center">
                <p class="font-mono text-xs uppercase tracking-widest text-zinc-500 mb-2">[ARCHIVO VACÍO]</p>
                <p class="text-xl font-bold text-white">No hay casos publicados en esta disciplina</p>
                <p class="mt-1 text-sm text-zinc-400">Explora otra categoría o publica un nuevo proyecto en el estudio.</p>
                <a href="{{ route('projects.index') }}"
                   class="mt-6 inline-block rounded-full bg-zinc-100 px-5 py-2.5 text-xs font-semibold text-zinc-950 hover:bg-white transition">
                    Ver todo el portafolio
                </a>
            </div>
        @endforelse
    </section>
@endsection