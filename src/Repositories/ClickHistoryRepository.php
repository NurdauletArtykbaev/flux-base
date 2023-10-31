<?php

namespace Nurdaulet\FluxBase\Repositories;


class ClickHistoryRepository
{
    public function create($data)
    {

        config('flux-base.models.click_history')::create($data);
    }
}
