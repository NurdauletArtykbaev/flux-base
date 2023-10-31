<?php

namespace Nurdaulet\FluxBase\Facades;

use Illuminate\Support\Facades\Facade;

class FluxBaseReviewFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fluxBaseReview';
    }
}
