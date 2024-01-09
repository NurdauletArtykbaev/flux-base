<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportFile extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    protected $fillable = ['path','support_id'];


}
