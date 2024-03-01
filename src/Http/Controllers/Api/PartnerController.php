<?php

namespace Nurdaulet\FluxBase\Http\Controllers\Api;

use Nurdaulet\FluxBase\Http\Resources\PartnersResource;
use Nurdaulet\FluxBase\Repositories\PartnerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PartnerController
{
    public function __construct(private PartnerRepository $partnerRepository)
    {
    }
    public function index(Request $request)
    {
        $cityId = $request->header('city_id');

        return Cache::remember("partners_city_id" . $cityId, 269746, function () use ($cityId) {
            $partners = $this->partnerRepository->get($cityId);
            return PartnersResource::collection($partners);
        });
    }
}
