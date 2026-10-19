<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeliverableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'      => ['required', 'string', 'min:3', 'max:120'],
            'image_url'  => ['required', 'url', 'max:255'],
            'stage'      => ['required', Rule::in(['Research', 'Wireframe', 'UI Design', 'Prototype'])],
            'sort_order' => ['required', 'integer', 'min:1', 'max:99'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'      => 'El título del entregable visual es obligatorio.',
            'image_url.required'  => 'Debes ingresar la URL de la pantalla o entregable.',
            'image_url.url'       => 'La imagen del entregable debe ser una URL válida.',
            'stage.required'      => 'Selecciona la etapa del proceso UX/UI.',
            'stage.in'            => 'La etapa seleccionada no es válida.',
            'sort_order.required' => 'Indica el orden de aparición en la galería.',
            'sort_order.integer'  => 'El orden debe ser un número entero.',
        ];
    }
}