<?php

namespace Nurdaulet\FluxBase\Traits;

use Nurdaulet\FluxBase\Filters\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    public function scopeApplyFilters(Builder $builder, ModelFilter $modelFilter, array $filters): Builder
    {
        return $modelFilter->apply($builder, $filters);
    }
}
