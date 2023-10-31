<?php

namespace Nurdaulet\FluxBase\Repositories;

use Illuminate\Support\Facades\Cache;
use Nurdaulet\FluxBase\Http\Resources\BannersResource;

class BannerRepository
{
    public function get()
    {
        $lang = app()->getLocale();
        return Cache::remember("banners-new-$lang", config('flux-base.options.cache_expiration', 269746), function () {
            $banners = config('flux-base.models.banner')::active()->with(['catalog:id,name,slug'])->orderBy('sort')->get();
            return BannersResource::collection($banners);
        });
    }
}
