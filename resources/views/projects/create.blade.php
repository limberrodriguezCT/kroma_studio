@extends('layouts.app')

@section('title', 'Publicar Nuevo Caso de Estudio — Kroma Studio')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('projects.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
                ← Volver al Catálogo
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white mt-2">Publicar Nuevo Caso de Estudio</h1>
            <p class="text-sm text-slate-400 mt-1">Completa la información técnica y narrativa del proyecto para registrarlo en MySQL.</p>
        </div>

        <form action="{{ route('projects.store') }}" method="POST" class="rounded-3xl border border-slate-800 bg-slate-900/60 p-6 sm:p-10 space-y-6 shadow-2xl">
            @csrf

            <!-- Selectores Relacionales (Llaves Foráneas: category_id y client_id) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="category_id" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Disciplina / Categoría (FK) *
                    </label>
                    <select name="category_id" id="category_id" required
                            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
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
                    <label for="client_id" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Cliente Corporativo (FK) *
                    </label>
                    <select name="client_id" id="client_id" required
                            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
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

            <!-- Título y Slug Autogenerado -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Título del Caso de Estudio *
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                           placeholder="Ej. Rediseño de App Bancaria NovaPay"
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                    @error('title')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Slug (Identificador URL Amigable)
                    </label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                           placeholder="rediseno-app-bancaria-novapay"
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-slate-300 focus:border-indigo-500 focus:outline-none">
                    @error('slug')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Resumen Ejecutivo -->
            <div>
                <label for="summary" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                    Resumen Ejecutivo (Impacto y Métricas) *
                </label>
                <input type="text" name="summary" id="summary" value="{{ old('summary') }}" maxlength="255" required
                       placeholder="Ej. Incremento del 38% en conversión mediante un checkout sin fricción."
                       class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                @error('summary')
                    <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Reto UX y Solución UI -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="challenge_text" class="block text-xs font-bold uppercase tracking-wider text-rose-300 mb-2">
                        El Reto UX (Problema a Resolver) *
                    </label>
                    <textarea name="challenge_text" id="challenge_text" rows="5" required
                              placeholder="Describe los puntos de dolor e investigación de usuarios..."
                              class="w-full rounded-xl border border-slate-700 bg-slate-950 p-4 text-sm text-white focus:border-indigo-500 focus:outline-none">{{ old('challenge_text') }}</textarea>
                    @error('challenge_text')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="solution_text" class="block text-xs font-bold uppercase tracking-wider text-emerald-300 mb-2">
                        La Solución UI (Propuesta de Diseño) *
                    </label>
                    <textarea name="solution_text" id="solution_text" rows="5" required
                              placeholder="Describe el sistema visual, componentes y resultados..."
                              class="w-full rounded-xl border border-slate-700 bg-slate-950 p-4 text-sm text-white focus:border-indigo-500 focus:outline-none">{{ old('solution_text') }}</textarea>
                    @error('solution_text')
                        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- URLs de Recursos y Portada -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label for="cover_image" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        URL Imagen de Portada *
                    </label>
                    <input type="url" name="cover_image" id="cover_image" value="{{ old('cover_image') }}" required
                           placeholder="https://images.unsplash.com/..."
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label for="figma_url" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        URL Prototipo Figma (Opcional)
                    </label>
                    <input type="url" name="figma_url" id="figma_url" value="{{ old('figma_url') }}"
                           placeholder="https://www.figma.com/..."
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label for="live_url" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        URL Sitio en Vivo (Opcional)
                    </label>
                    <input type="url" name="live_url" id="live_url" value="{{ old('live_url') }}"
                           placeholder="https://ejemplo.com"
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                </div>
            </div>

            <!-- Fecha de Publicación y Destacado -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center pt-2">
                <div>
                    <label for="published_at" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Fecha de Publicación *
                    </label>
                    <input type="date" name="published_at" id="published_at" value="{{ old('published_at', date('Y-m-d')) }}" required
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                </div>

                <div class="pt-5">
                    <label class="inline-flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured'))
                               class="w-5 h-5 rounded border-slate-700 bg-slate-950 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm font-semibold text-slate-200">Marcar como Caso de Estudio Destacado (★)</span>
                    </label>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="pt-6 border-t border-slate-800 flex items-center justify-end gap-4">
                <a href="{{ route('projects.index') }}"
                   class="rounded-xl border border-slate-700 px-5 py-3 text-xs font-bold text-slate-300 hover:bg-slate-800 transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="rounded-xl bg-indigo-600 hover:bg-indigo-500 px-6 py-3 text-xs font-bold text-white shadow-lg shadow-indigo-600/30 transition">
                    Guardar y Publicar Caso
                </button>
            </div>
        </form>
    </div>

    <script>
        // Autogenerar el slug mientras el estudiante escribe el título
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