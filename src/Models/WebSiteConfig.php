<?php

namespace Nurdaulet\FluxBase\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSiteConfig extends Model
{
    use HasFactory;
    protected $fillable = [
        'config',
        'logo_primary',
        'logo_secondary',
        'font',
        'design',

    ];
    protected $casts = [
//        'config' => 'array'
    ];
}
