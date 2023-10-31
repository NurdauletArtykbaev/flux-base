<?php

namespace Nurdaulet\FluxBase\Http\Controllers;

use Nurdaulet\FluxBase\Http\Resources\Review\RatingResource;
use Nurdaulet\FluxBase\Repositories\RatingRepository;
use Illuminate\Support\Facades\Cache;

class RatingController
{
    public function __construct(
        private RatingRepository $ratingRepository,
    )
    {
    }

  
    public function __invoke()
    {
        $lang = app()->getLocale();
        return Cache::remember("ratings-$lang", config('flux-base.options.cache_expiration',3600), function () {
            $ratings = $this->ratingRepository->list();
            return RatingResource::collection($ratings);
        });
    }
}
