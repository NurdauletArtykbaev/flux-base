<?php

namespace Nurdaulet\FluxBase\Services\Search\Contracts;


interface SearchEngineContract
{
    public function search($index, $q = null);
    public function updateSynonym();
//    public function getHits($index);
    public function getTopSearches($index);
    public function delete($index, $id);
}
