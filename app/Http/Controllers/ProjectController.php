<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::withCount('projects')->orderBy('name')->get();

        $projects = Project::with(['category', 'client'])
            ->when($request->query('category'), function ($query, $categorySlug) {
                $query->whereHas('category', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })
            ->latest('published_at')
            ->get();

        return view('projects.index', compact('projects', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $clients = Client::orderBy('company_name')->get();

        return view('projects.create', compact('categories', 'clients'));
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $project = Project::create($request->validated());

        return redirect()
            ->route('projects.show', $project)
            ->with('success', '¡El caso de estudio "' . $project->title . '" fue publicado exitosamente!');
    }

    public function show(Project $project): View
    {
        $project->load(['category', 'client', 'deliverables', 'testimonials']);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        $categories = Category::orderBy('name')->get();
        $clients = Client::orderBy('company_name')->get();

        return view('projects.edit', compact('project', 'categories', 'clients'));
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $project->update($request->validated());

        return redirect()
            ->route('projects.show', $project)
            ->with('success', '¡El caso de estudio fue actualizado correctamente!');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $title = $project->title;
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'El caso de estudio "' . $title . '" fue eliminado del portafolio.');
    }
}