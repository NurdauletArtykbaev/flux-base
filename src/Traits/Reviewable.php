<?php

namespace Nurdaulet\FluxBase\Traits;

use Nurdaulet\FluxBase\Models\Review;

trait Reviewable
{
    public function reviews() {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function review() {
        return $this->morphOne(Review::class, 'reviewable');
    }
}
