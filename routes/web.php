<?php

use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('projects.index');
});

// 7 rutas RESTful para Proyectos (index, create, store, show, edit, update, destroy)
Route::resource('projects', ProjectController::class);

// Rutas anidadas para agregar y eliminar Entregables (Tabla 4)
Route::post('projects/{project}/deliverables', [DeliverableController::class, 'store'])
    ->name('projects.deliverables.store');
Route::delete('deliverables/{deliverable}', [DeliverableController::class, 'destroy'])
    ->name('deliverables.destroy');

// Rutas anidadas para agregar y eliminar Testimonios (Tabla 5)
Route::post('projects/{project}/testimonials', [TestimonialController::class, 'store'])
    ->name('projects.testimonials.store');
Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])
    ->name('testimonials.destroy');