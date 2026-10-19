@extends('layouts.app')

@section('title', 'Editar: ' . $project->title . ' — Kroma Studio')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('projects.show', $project) }}" class="text-xs font-semibold text-slate-400 hover:text-white transition">
                ← Volver al Caso de Estudio
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white mt-2">Editar Caso de Estudio</h1>
            <p class="text-sm text-slate-400 mt-1">Actualizando el registro #{{ $project->id }} en la base de datos.</p>
        </div>

        <form action="{{ route('projects.update', $project) }}" method="POST" class="rounded-3xl border border-slate-800 bg-slate-900/60 p-6 sm:p-10 space-y-6 shadow-2xl">
            @csrf
            @method('PUT')

            <!-- Selectores Relacionales (Llaves Foráneas) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="category_id" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Disciplina / Categoría (FK) *
                    </label>
                    <select name="category_id" id="category_id" required
                            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $project->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="client_id" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Cliente Corporativo (FK) *
                    </label>
                    <select name="client_id" id="client_id" required
                            class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @selected(old('client_id', $project->client_id) == $client->id)>
                                {{ $client->company_name }} ({{ $client->country }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Título y Slug -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Título del Caso de Estudio *
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label for="slug" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Slug (Identificador URL)
                    </label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $project->slug) }}" required
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-slate-300 focus:border-indigo-500 focus:outline-none">
                </div>
            </div>

            <!-- Resumen Ejecutivo -->
            <div>
                <label for="summary" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                    Resumen Ejecutivo *
                </label>
                <input type="text" name="summary" id="summary" value="{{ old('summary', $project->summary) }}" maxlength="255" required
                       class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
            </div>

            <!-- Reto UX y Solución UI -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="challenge_text" class="block text-xs font-bold uppercase tracking-wider text-rose-300 mb-2">
                        El Reto UX *
                    </label>
                    <textarea name="challenge_text" id="challenge_text" rows="5" required
                              class="w-full rounded-xl border border-slate-700 bg-slate-950 p-4 text-sm text-white focus:border-indigo-500 focus:outline-none">{{ old('challenge_text', $project->challenge_text) }}</textarea>
                </div>

                <div>
                    <label for="solution_text" class="block text-xs font-bold uppercase tracking-wider text-emerald-300 mb-2">
                        La Solución UI *
                    </label>
                    <textarea name="solution_text" id="solution_text" rows="5" required
                              class="w-full rounded-xl border border-slate-700 bg-slate-950 p-4 text-sm text-white focus:border-indigo-500 focus:outline-none">{{ old('solution_text', $project->solution_text) }}</textarea>
                </div>
            </div>

            <!-- URLs de Recursos -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label for="cover_image" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        URL Imagen de Portada *
                    </label>
                    <input type="url" name="cover_image" id="cover_image" value="{{ old('cover_image', $project->cover_image) }}" required
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label for="figma_url" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        URL Prototipo Figma
                    </label>
                    <input type="url" name="figma_url" id="figma_url" value="{{ old('figma_url', $project->figma_url) }}"
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label for="live_url" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        URL Sitio en Vivo
                    </label>
                    <input type="url" name="live_url" id="live_url" value="{{ old('live_url', $project->live_url) }}"
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                </div>
            </div>

            <!-- Fecha y Destacado -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center pt-2">
                <div>
                    <label for="published_at" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Fecha de Publicación *
                    </label>
                    <input type="date" name="published_at" id="published_at" value="{{ old('published_at', $project->published_at->format('Y-m-d')) }}" required
                           class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-indigo-500 focus:outline-none">
                </div>

                <div class="pt-5">
                    <label class="inline-flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $project->is_featured))
                               class="w-5 h-5 rounded border-slate-700 bg-slate-950 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm font-semibold text-slate-200">Marcar como Caso de Estudio Destacado (★)</span>
                    </label>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="pt-6 border-t border-slate-800 flex items-center justify-end gap-4">
                <a href="{{ route('projects.show', $project) }}"
                   class="rounded-xl border border-slate-700 px-5 py-3 text-xs font-bold text-slate-300 hover:bg-slate-800 transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="rounded-xl bg-indigo-600 hover:bg-indigo-500 px-6 py-3 text-xs font-bold text-white shadow-lg shadow-indigo-600/30 transition">
                    Actualizar Caso de Estudio
                </button>
            </div>
        </form>
    </div>
@endsection