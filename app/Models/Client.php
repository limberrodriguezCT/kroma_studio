<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'company_name',
        'contact_name',
        'contact_email',
        'industry',
        'country',
        'website_url',
        'logo_url',
    ];

    /**
     * Relación 1:N -> Un cliente tiene muchos proyectos (plural)
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id', 'id');
    }
}