@extends('layouts.app')

@section('title', $project->title . ' — KROMA®')

@section('content')
    <!-- Barra de Navegación Superior del Caso -->
    <div class="mb-8 pb-4 border-b border-white/[0.08] flex flex-wrap items-center justify-between gap-4">
        <a href="{{ route('projects.index') }}"
           class="font-mono text-xs uppercase tracking-wider text-zinc-400 hover:text-white transition">
            ← Volver al índice de casos
        </a>

        @auth
            <div class="flex items-center gap-3">
                <a href="{{ route('projects.edit', $project) }}"
                   class="rounded-full border border-white/15 bg-surface hover:bg-white hover:text-zinc-950 px-4 py-2 text-xs font-semibold text-white transition">
                    Editar Caso de Estudio
                </a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="form-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="rounded-full border border-rose-500/30 bg-rose-500/10 hover:bg-rose-500/20 px-4 py-2 text-xs font-semibold text-rose-300 transition">
                        Eliminar
                    </button>
                </form>
            </div>
        @endauth
    </div>

    <!-- Cabecera Editorial del Caso de Estudio -->
    <header class="mb-14">
        <div class="flex flex-wrap items-center gap-3 mb-5">
            <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-surface px-3.5 py-1 font-mono text-xs"
                  style="color: {{ $project->category->color_hex }}">
                <span class="w-2 h-2 rounded-full" style="background-color: {{ $project->category->color_hex }}"></span>
                {{ $project->category->name }}
            </span>

            @if ($project->is_featured)
                <span class="rounded-full border border-amber-400/30 bg-amber-400/10 px-3 py-1 font-mono text-[11px] text-amber-300">
                    ★ FEATURED WORK
                </span>
            @endif

            <span class="font-mono text-xs text-zinc-500">
                ID #{{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }} · {{ $project->published_at->format('d.m.Y') }}
            </span>
        </div>

        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-[1.06] max-w-5xl">
            {{ $project->title }}
        </h1>

        <p class="mt-6 text-lg sm:text-xl text-zinc-400 max-w-3xl leading-relaxed">
            {{ $project->summary }}
        </p>

        <!-- Ficha Técnica Arquitectónica (Conecta Tablas: clients y projects) -->
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 border-y border-white/[0.08] divide-y sm:divide-y-0 sm:divide-x divide-white/[0.08] bg-surface/40">
            <div class="p-5">
                <span class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 block">01 / CLIENTE</span>
                <span class="text-sm font-bold text-white mt-1.5 block">{{ $project->client->company_name }}</span>
                <span class="text-xs text-zinc-400">{{ $project->client->industry }} · {{ $project->client->country }}</span>
            </div>
            <div class="p-5">
                <span class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 block">02 / STAKEHOLDER</span>
                <span class="text-sm font-semibold text-zinc-200 mt-1.5 block">{{ $project->client->contact_name }}</span>
                <span class="font-mono text-xs text-zinc-400">{{ $project->client->contact_email }}</span>
            </div>
            <div class="p-5">
                <span class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 block">03 / ARCHIVO FIGMA</span>
                @if ($project->figma_url)
                    <a href="{{ $project->figma_url }}" target="_blank" class="text-sm font-bold text-white hover:underline mt-1.5 inline-block">
                        Inspeccionar Sistema UI ↗
                    </a>
                @else
                    <span class="text-xs text-zinc-500 mt-1.5 block">Bajo acuerdo NDA</span>
                @endif
            </div>
            <div class="p-5">
                <span class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 block">04 / DEPLOY EN VIVO</span>
                @if ($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" class="text-sm font-bold text-emerald-400 hover:underline mt-1.5 inline-block">
                        Visitar Producción ↗
                    </a>
                @else
                    <span class="text-xs text-zinc-500 mt-1.5 block">Staging Interno</span>
                @endif
            </div>
        </div>

        <!-- Portada Principal Cinematográfica -->
        <div class="mt-10 aspect-[16/9] w-full overflow-hidden rounded-2xl border border-white/[0.08] bg-surface">
            <img src="{{ $project->cover_image }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
        </div>
    </header>

    <!-- Narrativa de Diseño: El Problema vs La Solución -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 pb-16 mb-16 border-b border-white/[0.08]">
        <div class="lg:col-span-6 rounded-2xl border border-white/[0.08] bg-surface p-8 sm:p-10">
            <div class="flex items-center justify-between pb-4 mb-6 border-b border-white/[0.06]">
                <span class="font-mono text-xs uppercase tracking-widest text-rose-400">[01 // PROBLEM SPACE & UX CHALLENGE]</span>
                <span class="font-serif italic text-lg text-zinc-400">Diagnóstico</span>
            </div>
            <h2 class="text-xl font-bold text-white mb-4">Fricción detectada en la experiencia</h2>
            <p class="text-zinc-300 text-sm sm:text-base leading-relaxed whitespace-pre-line">{{ $project->challenge_text }}</p>
        </div>

        <div class="lg:col-span-6 rounded-2xl border border-white/[0.08] bg-surface p-8 sm:p-10">
            <div class="flex items-center justify-between pb-4 mb-6 border-b border-white/[0.06]">
                <span class="font-mono text-xs uppercase tracking-widest text-emerald-400">[02 // ARCHITECTURE & UI SOLUTION]</span>
                <span class="font-serif italic text-lg text-zinc-400">Ejecución</span>
            </div>
            <h2 class="text-xl font-bold text-white mb-4">Sistema visual e ingeniería aplicada</h2>
            <p class="text-zinc-300 text-sm sm:text-base leading-relaxed whitespace-pre-line">{{ $project->solution_text }}</p>
        </div>
    </section>

    <!-- =================================================================== -->
    <!-- TABLA 4: GALERÍA DE ENTREGABLES (deliverables)                      -->
    <!-- =================================================================== -->
    <section class="pb-16 mb-16 border-b border-white/[0.08]">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
            <div>
                <span class="font-mono text-xs uppercase tracking-widest text-zinc-500">[03 // DESIGN PROCESS & ARTIFACTS]</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-white mt-2">
                    Entregables del Proceso <span class="font-serif italic font-normal text-zinc-400">({{ $project->deliverables->count() }})</span>
                </h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            @forelse ($project->deliverables as $deliverable)
                <div class="group rounded-2xl border border-white/[0.08] bg-surface overflow-hidden flex flex-col justify-between">
                    <div class="relative aspect-[16/10] bg-obsidian overflow-hidden">
                        <img src="{{ $deliverable->image_url }}"
                             alt="{{ $deliverable->title }}"
                             class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                        <span class="absolute top-4 left-4 rounded-full bg-obsidian/90 backdrop-blur-md border border-white/15 px-3 py-1 font-mono text-[11px] text-zinc-200">
                            0{{ $deliverable->sort_order }} · {{ $deliverable->stage }}
                        </span>
                    </div>
                    <div class="p-5 flex items-center justify-between gap-4 border-t border-white/[0.06]">
                        <h3 class="font-semibold text-white text-sm sm:text-base">{{ $deliverable->title }}</h3>

                        @auth
                            <form action="{{ route('deliverables.destroy', $deliverable) }}" method="POST" class="form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-mono text-xs text-rose-400 hover:underline">
                                    [Borrar]
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-white/15 p-10 text-center font-mono text-xs text-zinc-500">
                    SIN ARTEFACTOS REGISTRADOS EN LA TABLA DELIVERABLES.
                </div>
            @endforelse
        </div>

        @auth
            <div class="rounded-2xl border border-white/10 bg-surface p-6 sm:p-8">
                <div class="font-mono text-xs uppercase tracking-widest text-zinc-400 mb-4">
                    + Adjuntar entregable visual a este caso (Tabla: deliverables)
                </div>
                <form action="{{ route('projects.deliverables.store', $project) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                    @csrf
                    <div class="sm:col-span-4">
                        <label class="block font-mono text-[11px] uppercase text-zinc-400 mb-1.5">Título de la pantalla</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Ej. Flujo de Onboarding Biométrico" required
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-3.5 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block font-mono text-[11px] uppercase text-zinc-400 mb-1.5">URL de Imagen (https://...)</label>
                        <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://images.unsplash.com/..." required
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-3.5 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block font-mono text-[11px] uppercase text-zinc-400 mb-1.5">Etapa</label>
                        <select name="stage" class="w-full rounded-xl border border-white/10 bg-obsidian px-3 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                            <option value="Research">Research</option>
                            <option value="Wireframe">Wireframe</option>
                            <option value="UI Design" selected>UI Design</option>
                            <option value="Prototype">Prototype</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2 flex flex-col justify-end">
                        <input type="hidden" name="sort_order" value="{{ $project->deliverables->count() + 1 }}">
                        <button type="submit" class="w-full rounded-xl bg-zinc-100 hover:bg-white text-zinc-950 px-4 py-2.5 text-xs font-bold transition">
                            Subir Pantalla
                        </button>
                    </div>
                </form>
            </div>
        @endauth
    </section>

    <!-- =================================================================== -->
    <!-- TABLA 5: TESTIMONIOS DEL CLIENTE (testimonials)                     -->
    <!-- =================================================================== -->
    <section>
        <div class="mb-10">
            <span class="font-mono text-xs uppercase tracking-widest text-zinc-500">[04 // CLIENT VALIDATION & IMPACT]</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-white mt-2">
                Evaluación del Cliente <span class="font-serif italic font-normal text-zinc-400">({{ $project->testimonials->count() }})</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            @forelse ($project->testimonials as $testimonial)
                <div class="rounded-2xl border border-white/[0.08] bg-surface p-8 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <div class="font-mono text-xs tracking-widest text-amber-300">
                                {!! str_repeat('★', $testimonial->rating) !!}{!! str_repeat('☆', 5 - $testimonial->rating) !!}
                                <span class="text-zinc-500 ml-1">({{ $testimonial->rating }}.0)</span>
                            </div>
                            @auth
                                <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-mono text-xs text-rose-400 hover:underline">
                                        [Eliminar]
                                    </button>
                                </form>
                            @endauth
                        </div>
                        <p class="font-serif italic text-xl sm:text-2xl text-zinc-200 leading-relaxed">
                            “{{ $testimonial->comment }}”
                        </p>
                    </div>
                    <div class="mt-6 pt-5 border-t border-white/[0.06] flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-white">{{ $testimonial->author_name }}</p>
                            <p class="font-mono text-xs text-zinc-400">{{ $testimonial->author_role }}</p>
                        </div>
                        <span class="font-mono text-[10px] uppercase tracking-widest text-emerald-400 border border-emerald-500/30 bg-emerald-500/10 px-2.5 py-1 rounded">
                            Verified
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-white/15 p-10 text-center font-mono text-xs text-zinc-500">
                    SIN RESEÑAS REGISTRADAS EN LA TABLA TESTIMONIALS.
                </div>
            @endforelse
        </div>

        @auth
            <div class="rounded-2xl border border-white/10 bg-surface p-6 sm:p-8">
                <div class="font-mono text-xs uppercase tracking-widest text-zinc-400 mb-4">
                    + Registrar reseña de stakeholder (Tabla: testimonials)
                </div>
                <form action="{{ route('projects.testimonials.store', $project) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                    @csrf
                    <div class="sm:col-span-4">
                        <label class="block font-mono text-[11px] uppercase text-zinc-400 mb-1.5">Autor</label>
                        <input type="text" name="author_name" placeholder="Ej. Elena Rostova" required
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-3.5 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block font-mono text-[11px] uppercase text-zinc-400 mb-1.5">Cargo / Empresa</label>
                        <input type="text" name="author_role" placeholder="Ej. VP of Product en NovaPay" required
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-3.5 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block font-mono text-[11px] uppercase text-zinc-400 mb-1.5">Calificación</label>
                        <select name="rating" class="w-full rounded-xl border border-white/10 bg-obsidian px-3 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                            <option value="5" selected>★★★★★ (5/5)</option>
                            <option value="4">★★★★☆ (4/5)</option>
                            <option value="3">★★★☆☆ (3/5)</option>
                            <option value="2">★★☆☆☆ (2/5)</option>
                            <option value="1">★☆☆☆☆ (1/5)</option>
                        </select>
                    </div>
                    <div class="sm:col-span-10">
                        <label class="block font-mono text-[11px] uppercase text-zinc-400 mb-1.5">Testimonio</label>
                        <input type="text" name="comment" placeholder="Escribe el impacto medible que tuvo el proyecto..." required
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-3.5 py-2.5 text-sm text-white focus:border-white focus:outline-none">
                    </div>
                    <div class="sm:col-span-2 flex flex-col justify-end">
                        <button type="submit" class="w-full rounded-xl bg-zinc-100 hover:bg-white text-zinc-950 px-4 py-2.5 text-xs font-bold transition">
                            Publicar Reseña
                        </button>
                    </div>
                </form>
            </div>
        @endauth
    </section>
@endsection 