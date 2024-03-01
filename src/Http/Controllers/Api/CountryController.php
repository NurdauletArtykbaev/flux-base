<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Illuminate\Http\Request;
use Nurdaulet\FluxBase\Http\Resources\CitiesResource;
use Nurdaulet\FluxBase\Http\Resources\CountriesResource;
use Illuminate\Support\Facades\Cache;

class CountryController
{


    public function index(Request $request)
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

    public function cities($id, Request $request)
    {

        return Cache::remember("countries-$id-cities" , config('flux-base.options.cache_expiration', 269746), function () use ($id)  {
            $cities = config('flux-base.models.city')::query()
                ->active()
                ->orderBy('name')
                ->where('country_id', $id)
                ->get();
            return CitiesResource::collection($cities);
        });
    }

}
