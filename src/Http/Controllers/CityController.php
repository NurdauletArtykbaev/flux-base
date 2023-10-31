<?php

namespace Nurdaulet\FluxBase\Http\Controllers;

use Illuminate\Http\Request;
use Nurdaulet\FluxBase\Http\Resources\CitiesResource;
use Nurdaulet\FluxBase\Services\CityService;

class CityController
{

    public function __construct(private readonly CityService $cityService)
    {
    }

    public function __invoke(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $cities = $this->cityService->get();
        $currentCityId = $this->cityService->getCurrentCityId($cities);
        return CitiesResource::collection($cities)->additional([ 'currentCityId' => $currentCityId,]);
    }

}
