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
            'comment'     => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'author_name.required' => 'El nombre del autor de la reseña es obligatorio.',
            'author_role.required' => 'El cargo o empresa del autor es obligatorio.',
            'rating.required'      => 'Selecciona una calificación de 1 a 5 estrellas.',
            'rating.min'           => 'La calificación mínima es de 1 estrella.',
            'rating.max'           => 'La calificación máxima es de 5 estrellas.',
            'comment.required'     => 'Escribe el comentario o testimonio del cliente.',
            'comment.min'          => 'El testimonio debe contener al menos :min caracteres.',
        ];
    }
}