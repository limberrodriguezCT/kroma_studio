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
            'title'      => ['required', 'string', 'min:4', 'max:120'],
            'image_url'  => ['required', 'url', 'max:255'],
            'stage'      => ['required', 'string', Rule::in(['Research', 'Wireframe', 'UI Design', 'Prototype'])],
            'sort_order' => ['required', 'integer', 'min:1', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'      => 'El título del entregable o pantalla es obligatorio.',
            'title.string'        => 'El título del entregable debe ser texto válido.',
            'title.min'           => 'El título del entregable debe tener al menos :min caracteres.',
            'title.max'           => 'El título del entregable no debe exceder los :max caracteres.',

            'image_url.required'  => 'La URL de la imagen del entregable es obligatoria.',
            'image_url.url'       => 'Debes ingresar una URL válida para la imagen del entregable (https://...).',
            'image_url.max'       => 'La URL de la imagen no debe superar los :max caracteres.',

            'stage.required'      => 'Debes seleccionar la etapa del proceso de diseño.',
            'stage.in'            => 'La etapa seleccionada no es válida (debe ser Research, Wireframe, UI Design o Prototype).',

            'sort_order.required' => 'Debes indicar el número de orden de visualización.',
            'sort_order.integer'  => 'El orden de visualización debe ser un número entero.',
            'sort_order.min'      => 'El orden mínimo es :min.',
            'sort_order.max'      => 'El orden máximo permitido es :max.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'      => 'título del entregable',
            'image_url'  => 'URL de la imagen',
            'stage'      => 'etapa de diseño',
            'sort_order' => 'orden de visualización',
        ];
    }
}