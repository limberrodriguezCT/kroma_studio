<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestimonialRequest;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;

class TestimonialController extends Controller
{
    public function store(StoreTestimonialRequest $request, Project $project): RedirectResponse
    {
        $project->testimonials()->create(array_merge(
            $request->validated(),
            ['is_approved' => true]
        ));

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Testimonio del cliente registrado exitosamente.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $project = $testimonial->project;
        $testimonial->delete();

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Testimonio eliminado.');
    }
}