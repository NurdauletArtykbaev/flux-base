<?php

namespace Nurdaulet\FluxBase\Services\Search\Facades;

use Illuminate\Support\Facades\Facade;

class Search extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fluxBaseSearch';
    }
}
