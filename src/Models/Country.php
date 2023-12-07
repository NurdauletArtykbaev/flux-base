<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name','phone_code', 'icon', 'is_active'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}
