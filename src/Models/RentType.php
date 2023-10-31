<?php

namespace Nurdaulet\FluxBase\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Models\Ad;
use App\Models\RentProductPrice;
use App\Models\RentTypeProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class RentType extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, EagerLoadPivotTrait;

    protected $guarded = ['id'];
    public array $translatable = ['name'];


}
