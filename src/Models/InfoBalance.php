<?php

declare(strict_types=1);

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

final class InfoBalance extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title', 'description'];

    public array $translatable = ['title', 'description'];
}
