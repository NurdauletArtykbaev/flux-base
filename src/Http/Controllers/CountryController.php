<?php

namespace Nurdaulet\FluxBase\Http\Controllers;

use Illuminate\Http\Request;
use Nurdaulet\FluxBase\Http\Resources\CountriesResource;
use Illuminate\Support\Facades\Cache;

class CountryController
{


    public function __invoke(Request $request)
    {
        return Cache::remember("countries",  config('flux-base.options.cache_expiration', 269746), function () {
            return CountriesResource::collection(config('flux-base.models.country')::active()->with(['cities' => fn($query) => $query->active()])->get());
        });
    }

}
