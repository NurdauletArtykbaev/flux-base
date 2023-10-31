<?php

namespace Nurdaulet\FluxBase\Repositories;

class RatingRepository
{
    public function getByValue($value)
    {
        return config('flux-base.models.rating')::query()->where('rating', $value)->first();
    }

    public function list($relations = [])
    {
        return config('flux-base.models.rating')::query()
            ->with($relations)
            ->get();
    }
}
