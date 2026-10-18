<?php
// database/migrations/2026_01_01_000002_create_clients_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 120);
            $table->string('contact_name', 100);
            $table->string('contact_email', 150)->unique();
            $table->string('industry', 80);
            $table->string('country', 60);
            $table->string('website_url', 255)->nullable();
            $table->string('logo_url', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};