<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nurdaulet\FluxBase\Traits\HasFilters;
use Spatie\Translatable\HasTranslations;

class ComplaintReason extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, HasFilters;

    protected $table = 'complaint_reasons';
    protected $guarded = ['id'];
    public array $translatable = ['name'];
    protected $casts = [
        'is_for_user' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
