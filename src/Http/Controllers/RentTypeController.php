<?php

namespace Nurdaulet\FluxBase\Http\Controllers;

use Illuminate\Http\Request;
use Nurdaulet\FluxBase\Http\Resources\CitiesResource;
use Nurdaulet\FluxBase\Services\CityService;
use Nurdaulet\FluxBase\Http\Resources\RentTypeResource;

class RentTypeController
{


    public function __invoke(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return RentTypeResource::collection(config('flux-base.models.rent_type')::get());
    }

}
