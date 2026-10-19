@extends('layouts.app')

@section('title', $project->title . ' — Kroma Studio')

@section('content')
    <!-- Navegación Superior y Botones de Administración -->
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <a href="{{ route('projects.index') }}"
           class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition">
            <span>← Volver al Catálogo de Casos</span>
        </a>

        @auth
            <div class="flex items-center gap-3">
                <a href="{{ route('projects.edit', $project) }}"
                   class="rounded-xl border border-slate-700 bg-slate-900 hover:bg-slate-800 px-4 py-2 text-xs font-semibold text-white transition">
                    Editar Caso de Estudio
                </a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="form-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="rounded-xl border border-rose-500/40 bg-rose-500/10 hover:bg-rose-500/20 px-4 py-2 text-xs font-semibold text-rose-300 transition">
                        Eliminar Caso
                    </button>
                </form>
            </div>
        @endauth
    </div>

    <!-- Encabezado del Caso de Estudio (Conecta Tablas: categories, clients, projects) -->
    <header class="rounded-3xl border border-slate-800 bg-slate-900/60 overflow-hidden shadow-2xl mb-10">
        <div class="p-8 sm:p-12">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="rounded-full px-3.5 py-1 text-xs font-bold text-white"
                      style="background-color: {{ $project->category->color_hex }}">
                    {{ $project->category->name }}
                </span>
                @if ($project->is_featured)
                    <span class="rounded-full bg-amber-500/20 border border-amber-400/40 px-3 py-1 text-xs font-bold text-amber-300">
                        ★ Caso Destacado
                    </span>
                @endif
                <span class="text-xs text-slate-400">
                    Publicado el {{ $project->published_at->format('d/m/Y') }}
                </span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                {{ $project->title }}
            </h1>
            <p class="mt-4 text-lg text-slate-300 max-w-4xl leading-relaxed">
                {{ $project->summary }}
            </p>

            <!-- Ficha Técnica del Cliente y Enlaces Externos -->
            <div class="mt-8 pt-6 border-t border-slate-800/80 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <span class="text-[11px] uppercase tracking-wider font-bold text-slate-500 block">Cliente</span>
                    <span class="text-sm font-bold text-white mt-1 block">{{ $project->client->company_name }}</span>
                    <span class="text-xs text-slate-400">{{ $project->client->industry }} ({{ $project->client->country }})</span>
                </div>
                <div>
                    <span class="text-[11px] uppercase tracking-wider font-bold text-slate-500 block">Contacto Directo</span>
                    <span class="text-sm font-semibold text-slate-200 mt-1 block">{{ $project->client->contact_name }}</span>
                    <span class="text-xs text-indigo-400">{{ $project->client->contact_email }}</span>
                </div>
                <div>
                    <span class="text-[11px] uppercase tracking-wider font-bold text-slate-500 block">Prototipo en Figma</span>
                    @if ($project->figma_url)
                        <a href="{{ $project->figma_url }}" target="_blank" class="text-sm font-bold text-indigo-400 hover:text-indigo-300 mt-1 inline-block">
                            Abrir archivo en Figma ↗
                        </a>
                    @else
                        <span class="text-xs text-slate-500 mt-1 block">Confidencial / No disponible</span>
                    @endif
                </div>
                <div>
                    <span class="text-[11px] uppercase tracking-wider font-bold text-slate-500 block">Producto en Producción</span>
                    @if ($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" class="text-sm font-bold text-emerald-400 hover:text-emerald-300 mt-1 inline-block">
                            Visitar sitio en vivo ↗
                        </a>
                    @else
                        <span class="text-xs text-slate-500 mt-1 block">En desarrollo</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Imagen Principal de Portada -->
        <div class="h-80 sm:h-[460px] w-full bg-slate-950 border-t border-slate-800">
            <img src="{{ $project->cover_image }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
        </div>
    </header>

    <!-- Narrativa UX/UI: El Reto vs La Solución -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-14">
        <div class="rounded-3xl border border-rose-500/20 bg-gradient-to-br from-rose-950/20 to-slate-900/70 p-8">
            <span class="inline-block rounded-lg bg-rose-500/20 px-3 py-1 text-xs font-bold text-rose-300 mb-3">
                01. El Reto UX (Problema Detectado)
            </span>
            <h2 class="text-xl font-bold text-white mb-3">¿Qué fricción enfrentaban los usuarios?</h2>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed whitespace-pre-line">{{ $project->challenge_text }}</p>
        </div>

        <div class="rounded-3xl border border-emerald-500/20 bg-gradient-to-br from-emerald-950/20 to-slate-900/70 p-8">
            <span class="inline-block rounded-lg bg-emerald-500/20 px-3 py-1 text-xs font-bold text-emerald-300 mb-3">
                02. La Solución UI & Arquitectura
            </span>
            <h2 class="text-xl font-bold text-white mb-3">¿Cómo lo resolvimos desde el diseño?</h2>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed whitespace-pre-line">{{ $project->solution_text }}</p>
        </div>
    </section>

    <!-- =================================================================== -->
    <!-- TABLA 4: GALERÍA DE ENTREGABLES (deliverables)                      -->
    <!-- =================================================================== -->
    <section class="mb-16">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-6 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-400">Proceso de Diseño</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                    Artefactos y Entregables Visuales ({{ $project->deliverables->count() }})
                </h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            @forelse ($project->deliverables as $deliverable)
                <div class="rounded-2xl border border-slate-800 bg-slate-900/60 overflow-hidden flex flex-col justify-between">
                    <div class="relative h-60 bg-slate-950">
                        <img src="{{ $deliverable->image_url }}" alt="{{ $deliverable->title }}" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 rounded-lg bg-slate-950/80 backdrop-blur-md border border-slate-700 px-3 py-1 text-xs font-bold text-indigo-300">
                            Etapa {{ $deliverable->sort_order }}: {{ $deliverable->stage }}
                        </span>
                    </div>
                    <div class="p-5 flex items-center justify-between gap-4">
                        <h3 class="font-bold text-white text-base">{{ $deliverable->title }}</h3>

                        @auth
                            <form action="{{ route('deliverables.destroy', $deliverable) }}" method="POST" class="form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-semibold text-rose-400 hover:text-rose-300">
                                    Borrar
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-800 p-8 text-center text-sm text-slate-400">
                    Aún no se han cargado pantallas o entregables para este caso de estudio.
                </div>
            @endforelse
        </div>

        <!-- Formulario Incrustado para Añadir Entregable (Solo Usuarios Autenticados) -->
        @auth
            <div class="rounded-2xl border border-slate-800 bg-slate-900/90 p-6">
                <h3 class="text-sm font-bold text-white mb-4">+ Agregar nuevo entregable al proceso</h3>
                <form action="{{ route('projects.deliverables.store', $project) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                    @csrf
                    <div class="sm:col-span-4">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Título de la pantalla / artefacto</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Ej. Wireframes de Checkout" required
                               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-3.5 py-2 text-sm text-white focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">URL de la Imagen (https://...)</label>
                        <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://images.unsplash.com/..." required
                               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-3.5 py-2 text-sm text-white focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Etapa UX/UI</label>
                        <select name="stage" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-white focus:border-indigo-500 focus:outline-none">
                            <option value="Research">Research</option>
                            <option value="Wireframe">Wireframe</option>
                            <option value="UI Design" selected>UI Design</option>
                            <option value="Prototype">Prototype</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2 flex flex-col justify-end">
                        <input type="hidden" name="sort_order" value="{{ $project->deliverables->count() + 1 }}">
                        <button type="submit" class="w-full rounded-xl bg-indigo-600 hover:bg-indigo-500 px-4 py-2 text-xs font-bold text-white transition h-[38px]">
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
        <div class="mb-6">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Validación e Impacto</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                Reseñas del Cliente ({{ $project->testimonials->count() }})
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            @forelse ($project->testimonials as $testimonial)
                <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <div class="text-amber-400 text-sm tracking-widest">
                                {!! str_repeat('★', $testimonial->rating) !!}{!! str_repeat('☆', 5 - $testimonial->rating) !!}
                            </div>
                            @auth
                                <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold text-rose-400 hover:text-rose-300">
                                        Eliminar
                                    </button>
                                </form>
                            @endauth
                        </div>
                        <p class="text-slate-300 text-sm italic leading-relaxed">
                            "{{ $testimonial->comment }}"
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-800/80">
                        <p class="text-sm font-bold text-white">{{ $testimonial->author_name }}</p>
                        <p class="text-xs text-slate-400">{{ $testimonial->author_role }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-800 p-8 text-center text-sm text-slate-400">
                    Este caso de estudio aún no tiene testimonios registrados.
                </div>
            @endforelse
        </div>

        <!-- Formulario Incrustado para Añadir Testimonio (Solo Usuarios Autenticados) -->
        @auth
            <div class="rounded-2xl border border-slate-800 bg-slate-900/90 p-6">
                <h3 class="text-sm font-bold text-white mb-4">+ Registrar testimonio de cliente</h3>
                <form action="{{ route('projects.testimonials.store', $project) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                    @csrf
                    <div class="sm:col-span-4">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Nombre del Autor</label>
                        <input type="text" name="author_name" placeholder="Ej. Elena Rostova" required
                               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-3.5 py-2 text-sm text-white focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Cargo y Empresa</label>
                        <input type="text" name="author_role" placeholder="Ej. Product Manager en NovaPay" required
                               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-3.5 py-2 text-sm text-white focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Calificación</label>
                        <select name="rating" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-white focus:border-indigo-500 focus:outline-none">
                            <option value="5" selected>★★★★★ (5 Estrellas)</option>
                            <option value="4">★★★★☆ (4 Estrellas)</option>
                            <option value="3">★★★☆☆ (3 Estrellas)</option>
                            <option value="2">★★☆☆☆ (2 Estrellas)</option>
                            <option value="1">★☆☆☆☆ (1 Estrella)</option>
                        </select>
                    </div>
                    <div class="sm:col-span-10">
                        <label class="block text-xs font-semibold text-slate-400 mb-1">Comentario o Reseña</label>
                        <input type="text" name="comment" placeholder="Describe el impacto del diseño en métricas o usabilidad..." required
                               class="w-full rounded-xl border border-slate-700 bg-slate-950 px-3.5 py-2 text-sm text-white focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div class="sm:col-span-2 flex flex-col justify-end">
                        <button type="submit" class="w-full rounded-xl bg-emerald-600 hover:bg-emerald-500 px-4 py-2 text-xs font-bold text-white transition h-[38px]">
                            Guardar Reseña
                        </button>
                    </div>
                </form>
            </div>
        @endauth
    </section>
@endsection