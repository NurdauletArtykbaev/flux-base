<?php

namespace Nurdaulet\FluxBase\Services;


use Geocoder\Query\ReverseQuery;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Nurdaulet\FluxBase\Helpers\CityHelper;
use Nurdaulet\FluxBase\Models\City;
use Nurdaulet\FluxBase\Models\Country;
use Nurdaulet\FluxBase\Repositories\CityRepository;
use Psy\Exception\ErrorException;
use Stevebauman\Location\Facades\Location;

class CityService
{
    public function __construct(private readonly CityRepository $cityRepository)
    {
    }

    public function get()
    {
        return Cache::remember("cities", config('flux-base.options.cache_expiration', 269746), function () {
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
        [$resCountry, $resCity] = $this->getCountryAndCityFromGeocoder($lat, $lng);
        if (empty($resCity)) {
            throw new ErrorException('Город не найден',400);
        }
        $city = $this->cityRepository->findByName($resCity);

        if (!$city?->id) {
            $country = $this->cityRepository->countryFirstOrCreate($resCountry);
            $city = $this->cityRepository->createCity([
                'name' => $resCity,
                'country_id' => $country->id,
                'is_active' => true,
            ]);
        }
        return  $city;
    }

    private function getCountryAndCityFromGeocoder($lat, $lng)
    {
        $httpClient = new \Http\Discovery\Psr18Client();
        $provider = new \Geocoder\Provider\Yandex\Yandex($httpClient, null, config('flux-base.options.yandex_maps_api_key'));
        $result = $provider->reverseQuery(ReverseQuery::fromCoordinates($lat, $lng));
        $formatter = new \Geocoder\Formatter\StringFormatter();
        $result = $formatter->format($result->first(), '%L,%C');
        [$resCity, $resCountry] = explode(',', $result);
        return [ $resCountry, $resCity];
    }
}
