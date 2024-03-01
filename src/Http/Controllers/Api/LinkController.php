<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Illuminate\Http\Request;
use Nurdaulet\FluxBase\Http\Resources\LinksResource;

class LinkController
{


    public function __invoke(Request $request)
    {
        return LinksResource::collection(config('flux-base.models.link')::get());
    }

}
