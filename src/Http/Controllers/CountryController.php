<?php

namespace Nurdaulet\FluxBase\Http\Controllers;

use Illuminate\Http\Request;
use Nurdaulet\FluxBase\Http\Resources\CountriesResource;
use Illuminate\Support\Facades\Cache;

class CountryController
{


    public function __invoke(Request $request)
    {
        $filters = $request->input('filters',[]);

        return Cache::remember('countries' . json_encode($filters), config('flux-base.options.cache_expiration', 269746), function () use ($filters)  {
            $countries = config('flux-base.models.country')::query()
                ->active()
                ->orderBy('name')
                ->with(['cities' => fn($query) => $query->active()->when(isset($filters['city_name']), fn($query) => $query->where('cities.name', 'LIKE', '%' . $filters['city_name'] . '%'))])
                ->when(isset($filters['city_name']), fn($query) => $query->whereHas('cities', fn($query) => $query->where('cities.name', 'LIKE', '%' . $filters['city_name'] . '%')))
                ->get();
            return CountriesResource::collection($countries);
        });
    }

}
