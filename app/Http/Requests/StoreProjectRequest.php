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

    /**
     * Prepara y limpia datos antes de que pasen por rules()
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug'        => Str::slug((string) $this->title),
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
            'summary'        => ['required', 'string', 'min:15', 'max:255'],
            'challenge_text' => ['required', 'string', 'min:30'],
            'solution_text'  => ['required', 'string', 'min:30'],
            'cover_image'    => ['required', 'url', 'max:255'],
            'figma_url'      => ['nullable', 'url', 'max:255'],
            'live_url'       => ['nullable', 'url', 'max:255'],
            'published_at'   => ['required', 'date'],
            'is_featured'    => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required'    => 'Debes seleccionar una categoría de diseño para el proyecto.',
            'category_id.integer'     => 'El identificador de la categoría no tiene un formato válido.',
            'category_id.exists'      => 'La categoría seleccionada no existe en nuestra base de datos.',

            'client_id.required'      => 'Debes seleccionar el cliente o marca del proyecto.',
            'client_id.integer'       => 'El identificador del cliente no tiene un formato válido.',
            'client_id.exists'        => 'El cliente seleccionado no existe en nuestra base de datos.',

            'title.required'          => 'El título del caso de estudio es obligatorio.',
            'title.string'            => 'El título debe ser una cadena de texto válida.',
            'title.min'               => 'El título debe contener al menos :min caracteres.',
            'title.max'               => 'El título no puede exceder los :max caracteres.',
            'title.unique'            => 'Ya existe un caso de estudio registrado con este mismo título.',

            'slug.required'           => 'No se pudo generar el identificador URL (slug) del proyecto.',
            'slug.unique'             => 'El identificador URL (slug) generado para este título ya está en uso.',

            'summary.required'        => 'El resumen corto para la tarjeta del portafolio es obligatorio.',
            'summary.string'          => 'El resumen corto debe ser texto válido.',
            'summary.min'             => 'El resumen corto debe tener al menos :min caracteres para ser descriptivo.',
            'summary.max'             => 'El resumen corto no debe superar los :max caracteres.',

            'challenge_text.required' => 'Es obligatorio describir el reto o problema de UX del proyecto.',
            'challenge_text.string'   => 'El reto UX debe ser un texto válido.',
            'challenge_text.min'      => 'Explica mejor el reto UX (mínimo :min caracteres).',

            'solution_text.required'  => 'Es obligatorio describir la solución de diseño UI implementada.',
            'solution_text.string'    => 'La solución UI debe ser un texto válido.',
            'solution_text.min'       => 'Explica con mayor detalle la solución UI (mínimo :min caracteres).',

            'cover_image.required'    => 'La URL de la imagen de portada es obligatoria.',
            'cover_image.url'         => 'La imagen de portada debe ser una dirección URL válida (https://...).',
            'cover_image.max'         => 'La URL de la imagen de portada no debe superar los :max caracteres.',

            'figma_url.url'           => 'El enlace al prototipo de Figma debe ser una URL válida (https://...).',
            'figma_url.max'           => 'La URL de Figma no debe superar los :max caracteres.',

            'live_url.url'            => 'El enlace al sitio en vivo debe ser una URL válida (https://...).',
            'live_url.max'            => 'La URL del sitio en vivo no debe superar los :max caracteres.',

            'published_at.required'   => 'Debes indicar la fecha de publicación del proyecto.',
            'published_at.date'       => 'La fecha de publicación no tiene un formato de fecha válido.',

            'is_featured.boolean'     => 'El campo de proyecto destacado solo acepta verdadero o falso.',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id'    => 'categoría de diseño',
            'client_id'      => 'cliente',
            'title'          => 'título del proyecto',
            'slug'           => 'identificador URL (slug)',
            'summary'        => 'resumen corto',
            'challenge_text' => 'reto UX',
            'solution_text'  => 'solución UI',
            'cover_image'    => 'URL de imagen de portada',
            'figma_url'      => 'URL de Figma',
            'live_url'       => 'URL del proyecto en vivo',
            'published_at'   => 'fecha de publicación',
            'is_featured'    => 'proyecto destacado',
        ];
    }
}