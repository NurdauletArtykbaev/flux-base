<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',  'slug', 'sort', 'fields', 'is_active','text',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'fields' => 'json'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }
}
