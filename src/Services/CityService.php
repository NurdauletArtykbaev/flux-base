<?php

namespace Nurdaulet\FluxBase\Services;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Nurdaulet\FluxBase\Helpers\CityHelper;
use Nurdaulet\FluxBase\Repositories\CityRepository;
use Stevebauman\Location\Facades\Location;

class CityService
{
    public function __construct(private readonly CityRepository $cityRepository)
    {
    }

    public function get()
    {
        return Cache::remember("cities",  config('flux-base.options.cache_expiration', 269746), function () {
            return $this->cityRepository->get();
        });
    }

    public function getCurrentCityId($cities): ?int
    {
        $currentUserInfo = Location::get(request()->input('ip') ?? request()->ip());
        $city = Str::lower($currentUserInfo->cityName ?? null);
        $currentCityId = $cities->where('slug', $city)->first()?->id;
        if (empty($currentCityId)) {
            $currentCityId = CityHelper::DEFAULT_CITY_ID;
        }
        return $currentCityId;
    }

    public function getCityFromReverseGeo($lat, $lng)
    {
        return app('geocoder')->reverse($lat,$lng)->get();
    }

}
