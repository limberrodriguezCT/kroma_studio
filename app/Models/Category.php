<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'color_hex',
        'icon_name',
        'description',
    ];

    /**
     * Relación 1:N -> Una categoría tiene muchos proyectos (plural)
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'category_id', 'id');
    }
}