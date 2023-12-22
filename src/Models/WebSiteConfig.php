<?php

namespace Nurdaulet\FluxBase\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSiteConfig extends Model
{
    use HasFactory;
    protected $fillable = [
        'config'
    ];
    protected $casts = [
        'config' => 'array'
    ];
}
