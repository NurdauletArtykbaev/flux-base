<?php

namespace Nurdaulet\FluxBase\Http\Controllers;

use Nurdaulet\FluxBase\Http\Resources\TypeOrganizationsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TypeOrganizationController 
{

    public function __invoke(Request $request)
    {
        $lang = app()->getLocale();
        return Cache::remember("type-organizations-new-$lang", 269746, function () {
            $orgs = config('flux-base.models.type_organization')::select('id','name', 'slug')->active()->get();
            return TypeOrganizationsResource::collection($orgs);
        });
    }
}
