<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'category_id',
        'client_id',
        'title',
        'slug',
        'summary',
        'challenge_text',
        'solution_text',
        'cover_image',
        'figma_url',
        'live_url',
        'published_at',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'is_featured'  => 'boolean',
        ];
    }

    /**
     * Relación N:1 -> Un proyecto pertenece a una categoría (singular)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Relación N:1 -> Un proyecto pertenece a un cliente (singular)
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    /**
     * Relación 1:N -> Un proyecto tiene muchos entregables (plural)
     */
    public function deliverables(): HasMany
    {
        return $this->hasMany(Deliverable::class, 'project_id', 'id')->orderBy('sort_order', 'asc');
    }

    /**
     * Relación 1:N -> Un proyecto tiene muchos testimonios (plural)
     */
    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class, 'project_id', 'id')->latest();
    }
}