<?php

namespace Nurdaulet\FluxBase\Services\Search;


use Nurdaulet\FluxBase\Services\Search\Contracts\SearchEngineContract;

class SearchService
{

    public function __construct(private SearchEngineContract $engine)
    {
    }

    public function __call($method, array $parameters = [])
    {
        return $this->engine->{$method}(...$parameters);
    }

}
