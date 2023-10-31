<?php

namespace Nurdaulet\FluxBase\Repositories;


class SupportRepository
{
    public function create($data)
    {
        return config('flux-base.models.support')::create($data);
    }
}
