<?php

namespace Nurdaulet\FluxBase\Filters;

class ComplaintReasonFilter extends ModelFilter
{
    public function type($value)
    {
        if (empty($value)) {
            return $this;
        }
        return $this->builder->where('type', $value);
    }
}
