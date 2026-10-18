<?php

use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

// La raíz lleva al catálogo principal de Kroma Studio
Route::get('/', function () {
    return redirect()->route('projects.index');
});

// Cuando Breeze inicia sesión y envía a /dashboard, redirigimos al catálogo
Route::get('/dashboard', function () {
    return redirect()->route('projects.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por inicio de sesión de Breeze (Crear, Guardar, Editar, Actualizar, Eliminar)
Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class)->except(['index', 'show']);

    Route::post('projects/{project}/deliverables', [DeliverableController::class, 'store'])
        ->name('projects.deliverables.store');
    Route::delete('deliverables/{deliverable}', [DeliverableController::class, 'destroy'])
        ->name('deliverables.destroy');

    Route::post('projects/{project}/testimonials', [TestimonialController::class, 'store'])
        ->name('projects.testimonials.store');
    Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])
        ->name('testimonials.destroy');

    // Rutas de perfil propias de Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas públicas de lectura (Cualquier visitante puede ver el portafolio y el detalle)
Route::resource('projects', ProjectController::class)->only(['index', 'show']);

// Archivo de rutas de autenticación generado por Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';