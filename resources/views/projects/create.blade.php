@extends('layouts.app')

@section('title', 'Publicar Caso de Estudio — KROMA®')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 pb-6 border-b border-white/[0.08]">
            <a href="{{ route('projects.index') }}" class="font-mono text-xs uppercase tracking-wider text-zinc-400 hover:text-white transition">
                ← Cancelar y volver al catálogo
            </a>
            <h1 class="text-3xl sm:text-4xl font-bold text-white mt-3">
                Publicar <span class="font-serif italic font-normal text-zinc-300">Nuevo Caso de Estudio</span>
            </h1>
            <p class="text-sm text-zinc-400 mt-1">
                Completa los campos validados mediante <code class="font-mono text-xs text-zinc-200">StoreProjectRequest</code> para insertar el registro en MySQL.
            </p>
        </div>

        <form action="{{ route('projects.store') }}" method="POST" class="rounded-2xl border border-white/[0.08] bg-surface p-6 sm:p-10 space-y-8">
            @csrf

            <!-- Bloque 01: Llaves Foráneas -->
            <div>
                <div class="font-mono text-xs uppercase tracking-widest text-zinc-500 mb-4 pb-2 border-b border-white/[0.06]">
                    [01 // RELACIONES DE BASE DE DATOS — LLAVES FORÁNEAS]
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="category_id" class="block font-mono text-xs uppercase text-zinc-300 mb-2">
                            Disciplina / Categoría (category_id) *
                        </label>
                        <select name="category_id" id="category_id" required
                                class="w-full rounded-xl border border-white/10 bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                            <option value="">Selecciona una disciplina...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="client_id" class="block font-mono text-xs uppercase text-zinc-300 mb-2">
                            Cliente Corporativo (client_id) *
                        </label>
                        <select name="client_id" id="client_id" required
                                class="w-full rounded-xl border border-white/10 bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                            <option value="">Selecciona un cliente...</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" @selected(old('client_id') == $client->id)>
                                    {{ $client->company_name }} ({{ $client->country }})
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Bloque 02: Identidad y Narrativa -->
            <div>
                <div class="font-mono text-xs uppercase tracking-widest text-zinc-500 mb-4 pb-2 border-b border-white/[0.06]">
                    [02 // IDENTIDAD Y NARRATIVA UX/UI]
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="title" class="block font-mono text-xs uppercase text-zinc-300 mb-2">
                            Título del Caso *
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                               placeholder="Ej. Ecosistema Digital FinTech Solaris"
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                        @error('title')
                            <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block font-mono text-xs uppercase text-zinc-300 mb-2">
                            Slug URL (Autogenerado)
                        </label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                               placeholder="ecosistema-digital-fintech-solaris"
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-4 py-3 font-mono text-xs text-zinc-400 focus:border-white focus:outline-none">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="summary" class="block font-mono text-xs uppercase text-zinc-300 mb-2">
                        Resumen Ejecutivo (Métrica Principal) *
                    </label>
                    <input type="text" name="summary" id="summary" value="{{ old('summary') }}" maxlength="255" required
                           placeholder="Ej. Reducción del 45% en tiempos de carga cognitiva y nuevo sistema de tokens."
                           class="w-full rounded-xl border border-white/10 bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="challenge_text" class="block font-mono text-xs uppercase text-rose-400 mb-2">
                            01. El Reto UX (Problema) *
                        </label>
                        <textarea name="challenge_text" id="challenge_text" rows="5" required
                                  placeholder="Describe el problema de investigación y fricción de los usuarios..."
                                  class="w-full rounded-xl border border-white/10 bg-obsidian p-4 text-sm text-white focus:border-white focus:outline-none">{{ old('challenge_text') }}</textarea>
                    </div>

                    <div>
                        <label for="solution_text" class="block font-mono text-xs uppercase text-emerald-400 mb-2">
                            02. La Solución UI (Ejecución) *
                        </label>
                        <textarea name="solution_text" id="solution_text" rows="5" required
                                  placeholder="Describe la arquitectura de interfaz, componentes y resultados..."
                                  class="w-full rounded-xl border border-white/10 bg-obsidian p-4 text-sm text-white focus:border-white focus:outline-none">{{ old('solution_text') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Bloque 03: Recursos y Metadatos -->
            <div>
                <div class="font-mono text-xs uppercase tracking-widest text-zinc-500 mb-4 pb-2 border-b border-white/[0.06]">
                    [03 // RECURSOS VISUALES Y PUBLICACIÓN]
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label for="cover_image" class="block font-mono text-xs uppercase text-zinc-300 mb-2">
                            URL Portada (Unsplash) *
                        </label>
                        <input type="url" name="cover_image" id="cover_image" value="{{ old('cover_image') }}" required
                               placeholder="https://images.unsplash.com/..."
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                    </div>

                    <div>
                        <label for="figma_url" class="block font-mono text-xs uppercase text-zinc-300 mb-2">
                            URL Archivo Figma
                        </label>
                        <input type="url" name="figma_url" id="figma_url" value="{{ old('figma_url') }}"
                               placeholder="https://www.figma.com/..."
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                    </div>

                    <div>
                        <label for="live_url" class="block font-mono text-xs uppercase text-zinc-300 mb-2">
                            URL Sitio en Vivo
                        </label>
                        <input type="url" name="live_url" id="live_url" value="{{ old('live_url') }}"
                               placeholder="https://..."
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center">
                    <div>
                        <label for="published_at" class="block font-mono text-xs uppercase text-zinc-300 mb-2">
                            Fecha de Publicación *
                        </label>
                        <input type="date" name="published_at" id="published_at" value="{{ old('published_at', date('Y-m-d')) }}" required
                               class="w-full rounded-xl border border-white/10 bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                    </div>

                    <div class="pt-5">
                        <label class="inline-flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured'))
                                   class="w-4 h-4 rounded border-white/20 bg-obsidian text-white focus:ring-0">
                            <span class="text-sm font-medium text-zinc-200">Destacar en portada (Featured Case ★)</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-white/[0.08] flex items-center justify-end gap-4">
                <a href="{{ route('projects.index') }}"
                   class="rounded-full border border-white/15 px-5 py-2.5 text-xs font-semibold text-zinc-300 hover:text-white transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="rounded-full bg-zinc-100 hover:bg-white text-zinc-950 px-6 py-2.5 text-xs font-bold transition">
                    Guardar Caso en Base de Datos
                </button>
            </div>
        </form>
    </div>

    <script>
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        titleInput?.addEventListener('input', () => {
            slugInput.value = titleInput.value
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-');
        });
    </script>
@endsection