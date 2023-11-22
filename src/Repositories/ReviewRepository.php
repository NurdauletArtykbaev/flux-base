<?php

namespace Nurdaulet\FluxBase\Repositories;


class ReviewRepository
{
    public function getByReviewable($reviewable)
    {
        return $reviewable->reviews()->whereNotNull('comment')->simplePaginate();
    }

    public function create($reviewable, $data)
    {
        return $reviewable->reviews()->updateOrCreate([
            'user_id' => $data['user_id']
        ],$data);
    }
}
