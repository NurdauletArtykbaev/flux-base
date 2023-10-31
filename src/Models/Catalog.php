<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Catalog extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $guarded = ['id'];
    public $translatable = ['name', 'seo_title', 'seo_text'];

}
