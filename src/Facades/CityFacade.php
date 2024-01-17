<?php

namespace Nurdaulet\FluxBase\Facades;

use Illuminate\Support\Facades\Facade;

class CityFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fluxBaseCity';
    }
}
