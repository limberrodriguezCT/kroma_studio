<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliverableRequest;
use App\Models\Deliverable;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;

class DeliverableController extends Controller
{
    public function store(StoreDeliverableRequest $request, Project $project): RedirectResponse
    {
        $project->deliverables()->create($request->validated());

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Entregable visual agregado a la galería del proyecto.');
    }

    public function destroy(Deliverable $deliverable): RedirectResponse
    {
        $project = $deliverable->project;
        $deliverable->delete();

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Entregable eliminado de la galería.');
    }
}