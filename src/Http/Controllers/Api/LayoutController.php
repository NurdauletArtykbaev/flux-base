<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Illuminate\Http\Request;
use Nurdaulet\FluxBase\Http\Resources\LayoutResource;
use Illuminate\Support\Facades\Cache;

class LayoutController
{
    public function __invoke()
    {
        return Cache::remember("layout", 269746, function () {
            return LayoutResource::collection(config('flux-base.models.layout')::active()->orderBy('sort')->get());
        });
    }
}
