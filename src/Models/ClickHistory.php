<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ClickHistory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'click_histories';
    protected $guarded = ['id'];

    protected $casts = [
        'fields'  => 'json'
    ];
}
