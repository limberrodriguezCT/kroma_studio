<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author_name' => ['required', 'string', 'min:3', 'max:100'],
            'author_role' => ['required', 'string', 'min:3', 'max:100'],
            'rating'      => ['required', 'integer', 'min:1', 'max:5'],
            'comment'     => ['required', 'string', 'min:15', 'max:600'],
        ];
    }

    public function messages(): array
    {
        return [
            'author_name.required' => 'El nombre del autor de la reseña es obligatorio.',
            'author_name.string'   => 'El nombre del autor debe ser texto válido.',
            'author_name.min'      => 'El nombre del autor debe tener al menos :min caracteres.',
            'author_name.max'      => 'El nombre del autor no puede exceder los :max caracteres.',

            'author_role.required' => 'El cargo o puesto del autor es obligatorio.',
            'author_role.string'   => 'El cargo del autor debe ser texto válido.',
            'author_role.min'      => 'El cargo del autor debe tener al menos :min caracteres.',
            'author_role.max'      => 'El cargo del autor no puede exceder los :max caracteres.',

            'rating.required'      => 'Debes seleccionar una calificación de estrellas.',
            'rating.integer'       => 'La calificación debe ser un número entero.',
            'rating.min'           => 'La calificación mínima es de :min estrella.',
            'rating.max'           => 'La calificación máxima es de :max estrellas.',

            'comment.required'     => 'El comentario del testimonio es obligatorio.',
            'comment.string'       => 'El testimonio debe ser texto válido.',
            'comment.min'          => 'El testimonio debe tener al menos :min caracteres.',
            'comment.max'          => 'El testimonio no debe superar los :max caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'author_name' => 'nombre del autor',
            'author_role' => 'cargo del autor',
            'rating'      => 'calificación',
            'comment'     => 'comentario',
        ];
    }
}