@extends('layouts.app')

@section('title', 'Nuevo Caso de Estudio — KROMA®')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="mb-10 pb-6 border-b border-white/[0.08] flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <a href="{{ route('projects.index') }}" class="font-mono text-xs uppercase tracking-wider text-zinc-400 hover:text-white transition">
                    ← Volver al catálogo
                </a>
                <h1 class="text-3xl sm:text-5xl font-bold text-white mt-3 tracking-tight">
                    Publicar <span class="font-serif italic font-normal text-zinc-300">Caso de Estudio</span>
                </h1>
            </div>
            <span class="font-mono text-xs text-zinc-500 uppercase tracking-widest">[EDITOR DE PORTAFOLIO]</span>
        </div>

        <form action="{{ route('projects.store') }}" method="POST" novalidate class="space-y-10">
            @csrf

            <!-- Bloque 01: Clasificación y Cliente -->
            <div class="rounded-2xl border border-white/[0.08] bg-surface p-6 sm:p-9">
                <div class="font-mono text-xs uppercase tracking-widest text-zinc-400 mb-6 pb-3 border-b border-white/[0.06]">
                    01 / Clasificación y Cliente
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="category_id" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                            Disciplina de Diseño *
                        </label>
                        <select name="category_id" id="category_id"
                                class="w-full rounded-xl border {{ $errors->has('category_id') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3.5 text-sm text-white focus:border-white focus:outline-none">
                            <option value="">Selecciona una especialidad...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="client_id" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                            Cliente / Marca *
                        </label>
                        <select name="client_id" id="client_id"
                                class="w-full rounded-xl border {{ $errors->has('client_id') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3.5 text-sm text-white focus:border-white focus:outline-none">
                            <option value="">Selecciona la empresa cliente...</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" @selected(old('client_id') == $client->id)>
                                    {{ $client->company_name }} · {{ $client->country }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Bloque 02: Narrativa del Caso de Estudio -->
            <div class="rounded-2xl border border-white/[0.08] bg-surface p-6 sm:p-9 space-y-6">
                <div class="font-mono text-xs uppercase tracking-widest text-zinc-400 mb-2 pb-3 border-b border-white/[0.06]">
                    02 / Narrativa del Caso de Estudio
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-12 gap-6">
                    <div class="sm:col-span-7">
                        <label for="title" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                            Título del Proyecto *
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                               placeholder="Ej. Rediseño de Banca Móvil Solaris 2.0"
                               class="w-full rounded-xl border {{ $errors->has('title') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3.5 text-sm text-white focus:border-white focus:outline-none">
                        @error('title')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-5">
                        <label for="slug" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                            Enlace Permanente (Slug)
                        </label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                               placeholder="rediseno-banca-movil-solaris"
                               class="w-full rounded-xl border {{ $errors->has('slug') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3.5 font-mono text-xs text-zinc-400 focus:border-white focus:outline-none">
                        @error('slug')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="summary" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                        Resumen de Impacto (1 línea para el catálogo) *
                    </label>
                    <input type="text" name="summary" id="summary" value="{{ old('summary') }}" maxlength="255"
                           placeholder="Ej. Incremento del 42% en retención mediante una nueva arquitectura de información."
                           class="w-full rounded-xl border {{ $errors->has('summary') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3.5 text-sm text-white focus:border-white focus:outline-none">
                    @error('summary')
                        <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    <div>
                        <label for="challenge_text" class="block font-mono text-[11px] uppercase tracking-wider text-rose-400 mb-2">
                            El Reto UX (Problema e Investigación) *
                        </label>
                        <textarea name="challenge_text" id="challenge_text" rows="5"
                                  placeholder="¿Qué problema enfrentaban los usuarios antes del rediseño?"
                                  class="w-full rounded-xl border {{ $errors->has('challenge_text') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian p-4 text-sm text-white focus:border-white focus:outline-none leading-relaxed">{{ old('challenge_text') }}</textarea>
                        @error('challenge_text')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="solution_text" class="block font-mono text-[11px] uppercase tracking-wider text-emerald-400 mb-2">
                            La Solución UI (Diseño y Sistema Visual) *
                        </label>
                        <textarea name="solution_text" id="solution_text" rows="5"
                                  placeholder="¿Cómo se resolvió a nivel de interfaz, prototipado y diseño?"
                                  class="w-full rounded-xl border {{ $errors->has('solution_text') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian p-4 text-sm text-white focus:border-white focus:outline-none leading-relaxed">{{ old('solution_text') }}</textarea>
                        @error('solution_text')
                            <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Bloque 03: Portada con Previsualización y Enlaces -->
            <div class="rounded-2xl border border-white/[0.08] bg-surface p-6 sm:p-9">
                <div class="font-mono text-xs uppercase tracking-widest text-zinc-400 mb-6 pb-3 border-b border-white/[0.06]">
                    03 / Dirección Visual y Enlaces Externos
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <div class="lg:col-span-7 space-y-5">
                        <div>
                            <label for="cover_image" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                                URL de Imagen de Portada *
                            </label>
                            <input type="url" name="cover_image" id="cover_image" value="{{ old('cover_image') }}"
                                   placeholder="https://images.unsplash.com/photo-..."
                                   class="w-full rounded-xl border {{ $errors->has('cover_image') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                            @error('cover_image')
                                <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="figma_url" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                                    Enlace a Figma (Opcional)
                                </label>
                                <input type="url" name="figma_url" id="figma_url" value="{{ old('figma_url') }}"
                                       placeholder="https://www.figma.com/..."
                                       class="w-full rounded-xl border {{ $errors->has('figma_url') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                                @error('figma_url')
                                    <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="live_url" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                                    Sitio en Producción (Opcional)
                                </label>
                                <input type="url" name="live_url" id="live_url" value="{{ old('live_url') }}"
                                       placeholder="https://..."
                                       class="w-full rounded-xl border {{ $errors->has('live_url') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                                @error('live_url')
                                    <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center pt-2">
                            <div>
                                <label for="published_at" class="block font-mono text-[11px] uppercase tracking-wider text-zinc-400 mb-2">
                                    Fecha de Lanzamiento *
                                </label>
                                <input type="date" name="published_at" id="published_at" value="{{ old('published_at', date('Y-m-d')) }}"
                                       class="w-full rounded-xl border {{ $errors->has('published_at') ? 'border-rose-500/80' : 'border-white/10' }} bg-obsidian px-4 py-3 text-sm text-white focus:border-white focus:outline-none">
                                @error('published_at')
                                    <p class="mt-1.5 font-mono text-xs text-rose-400">↳ {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-5">
                                <label class="inline-flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured'))
                                           class="w-4 h-4 rounded border-white/20 bg-obsidian text-white focus:ring-0">
                                    <span class="text-sm font-medium text-zinc-200">Destacar caso en portada (★)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Previsualización en Vivo de la Portada -->
                    <div class="lg:col-span-5">
                        <span class="block font-mono text-[11px] uppercase tracking-wider text-zinc-500 mb-2">
                            Vista Previa de Portada (16:10)
                        </span>
                        <div class="aspect-[16/10] w-full rounded-2xl border border-white/10 bg-obsidian overflow-hidden flex items-center justify-center relative">
                            <img id="cover_preview" src="{{ old('cover_image') }}" alt="Preview"
                                 class="{{ old('cover_image') ? '' : 'hidden' }} w-full h-full object-cover">
                            <span id="cover_placeholder" class="{{ old('cover_image') ? 'hidden' : '' }} font-mono text-xs text-zinc-600 text-center px-6">
                                Pega una URL de imagen para previsualizar el encuadre
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('projects.index') }}"
                   class="rounded-full border border-white/15 px-6 py-3 text-xs font-semibold text-zinc-300 hover:text-white transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="rounded-full bg-zinc-100 hover:bg-white text-zinc-950 px-8 py-3 text-xs font-bold uppercase tracking-wider transition">
                    Publicar Caso de Estudio →
                </button>
            </div>
        </form>
    </div>

    <script>
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        const coverInput = document.getElementById('cover_image');
        const coverPreview = document.getElementById('cover_preview');
        const coverPlaceholder = document.getElementById('cover_placeholder');

        titleInput?.addEventListener('input', () => {
            slugInput.value = titleInput.value
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-');
        });

        coverInput?.addEventListener('input', () => {
            const url = coverInput.value.trim();
            if (url.startsWith('http')) {
                coverPreview.src = url;
                coverPreview.classList.remove('hidden');
                coverPlaceholder.classList.add('hidden');
            } else {
                coverPreview.classList.add('hidden');
                coverPlaceholder.classList.remove('hidden');
            }
        });
    </script>
@endsection