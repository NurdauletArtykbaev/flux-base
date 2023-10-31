<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileVersion extends Model
{
    use HasFactory;
    protected $fillable = [
        'version',
        'ios_version',
        'android_version',
    ];
}
