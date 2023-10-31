<?php

namespace Nurdaulet\FluxBase\Repositories;


class PartnerRepository
{

    public function get($cityId = null)
    {
        return config('flux-base.models.partner')::active()
            ->with('partner:id,name,surname,company_name,avatar,avg_rating')
            ->when($cityId, fn($query) => $query->whereHas('cities', fn($query) => $query->where('city_id', $cityId)))
            ->limit(10)
            ->groupBy('user_id')
            ->orderBy('lft')
            ->get();
    }
}
