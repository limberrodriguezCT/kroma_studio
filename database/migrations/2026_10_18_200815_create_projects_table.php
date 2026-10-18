<?php
// database/migrations/2026_01_01_000003_create_projects_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Llaves foráneas estrictas siguiendo la convención singular_id
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('title', 150)->unique();
            $table->string('slug', 170)->unique();
            $table->string('summary', 255);
            $table->text('challenge_text');
            $table->text('solution_text');
            $table->string('cover_image', 255);
            $table->string('figma_url', 255)->nullable();
            $table->string('live_url', 255)->nullable();
            $table->date('published_at');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};