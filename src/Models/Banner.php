<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $guarded = ['id'];

    public array $translatable = ['name', 'description'];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rentType()
    {
        return $this->belongsTo(RentType::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }


    public function getImageUrlAttribute()
    {
        return config('filesystems.disks.s3.url') . '/' . $this->image;
    }
}
