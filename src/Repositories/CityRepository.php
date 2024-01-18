<?php

namespace Nurdaulet\FluxBase\Repositories;


class CityRepository
{
    public function get()
    {
        return config('flux-base.models.city')::select('id', 'name', 'slug', 'is_active', 'lat', 'lng')->active()->get();
    }

    public function findByName($name)
    {
        $name = trim($name);
        return config('flux-base.models.city')::select('id', 'name', 'slug')->where('name', 'like', "%$name%")->first();
    }

    public function createCity($data)
    {
        return config('flux-base.models.city')::create($data);
    }

    public function countryFirstOrCreate($name)
    {
        $name = trim($name);
        return config('flux-base.models.country')::firstOrCreate(
            [
                'name' => $name
            ],
            [
                'name' => $name,
                'is_active' => true
            ]);
    }
}
