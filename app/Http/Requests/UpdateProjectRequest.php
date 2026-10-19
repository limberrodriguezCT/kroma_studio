<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
        $projectId = $this->route('project')->id;

        return [
            'category_id'    => ['required', 'integer', 'exists:categories,id'],
            'client_id'      => ['required', 'integer', 'exists:clients,id'],
            'title'          => ['required', 'string', 'min:5', 'max:150', Rule::unique('projects', 'title')->ignore($projectId)],
            'slug'           => ['required', 'string', 'max:170', Rule::unique('projects', 'slug')->ignore($projectId)],
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
        return (new StoreProjectRequest())->messages();
    }
}