<?php

namespace Nurdaulet\FluxBase\Facades;

use Illuminate\Support\Facades\Facade;

class TextConverter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'textConverter';
    }
}
