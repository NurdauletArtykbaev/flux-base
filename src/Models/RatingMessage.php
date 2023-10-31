<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class RatingMessage extends Model
{
    use SoftDeletes, HasTranslations;

    protected $fillable = [
        'message',
        'rating_id',
    ];
    public $translatable = ['message'];

    public function rating() {
        return $this->belongsTo(Rating::class);
    }
}
