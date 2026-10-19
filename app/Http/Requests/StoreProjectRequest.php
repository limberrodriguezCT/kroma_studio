<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug'        => Str::slug($this->slug ?: $this->title),
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }

    public function rules(): array
    {
        return [
            'category_id'    => ['required', 'integer', 'exists:categories,id'],
            'client_id'      => ['required', 'integer', 'exists:clients,id'],
            'title'          => ['required', 'string', 'min:5', 'max:150', 'unique:projects,title'],
            'slug'           => ['required', 'string', 'max:170', 'unique:projects,slug'],
            'summary'        => ['required', 'string', 'min:10', 'max:255'],
            'challenge_text' => ['required', 'string', 'min:20'],
            'solution_text'  => ['required', 'string', 'min:20'],
            'cover_image'    => ['required', 'url', 'max:255'],
            'figma_url'      => ['nullable', 'url', 'max:255'],
            'live_url'       => ['nullable', 'url', 'max:255'],
            'published_at'   => ['required', 'date'],
            'is_featured'    => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required'    => 'Debes seleccionar una disciplina o categoría de diseño.',
            'category_id.exists'      => 'La categoría seleccionada no existe en la base de datos.',
            'client_id.required'      => 'Debes asignar un cliente al caso de estudio.',
            'client_id.exists'        => 'El cliente seleccionado no es válido.',
            'title.required'          => 'El título del caso de estudio es obligatorio.',
            'title.min'               => 'El título debe tener al menos :min caracteres.',
            'title.unique'            => 'Ya existe un caso de estudio registrado con este título.',
            'slug.unique'             => 'El identificador URL (slug) ya está en uso.',
            'summary.required'        => 'El resumen ejecutivo es obligatorio para la tarjeta del catálogo.',
            'summary.max'             => 'El resumen no puede exceder los :max caracteres.',
            'challenge_text.required' => 'Debes describir el reto UX del proyecto.',
            'challenge_text.min'      => 'Explica el reto UX con al menos :min caracteres.',
            'solution_text.required'  => 'Debes describir la solución UI propuesta.',
            'solution_text.min'       => 'Explica la solución UI con al menos :min caracteres.',
            'cover_image.required'    => 'La URL de la imagen de portada es obligatoria.',
            'cover_image.url'         => 'La imagen de portada debe ser una URL válida (https://...).',
            'figma_url.url'           => 'El enlace de Figma debe ser una URL válida.',
            'live_url.url'            => 'El enlace del sitio en vivo debe ser una URL válida.',
            'published_at.required'   => 'Indica la fecha de publicación del proyecto.',
            'published_at.date'       => 'El formato de la fecha de publicación no es válido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id'    => 'categoría',
            'client_id'      => 'cliente',
            'title'          => 'título del proyecto',
            'summary'        => 'resumen ejecutivo',
            'challenge_text' => 'reto UX',
            'solution_text'  => 'solución UI',
            'cover_image'    => 'imagen de portada',
            'figma_url'      => 'enlace a Figma',
            'live_url'       => 'enlace en vivo',
            'published_at'   => 'fecha de publicación',
        ];
    }
}