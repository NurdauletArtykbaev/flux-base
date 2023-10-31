<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Rating extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $timestamps = false;

    protected $guarded = [
        'id'
    ];
    public $translatable = ['name'];

    public function messages()
    {
        return $this->hasMany(RatingMessage::class);
    }
}
