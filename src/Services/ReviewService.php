<?php

namespace Nurdaulet\FluxBase\Services;

use Nurdaulet\FluxBase\Repositories\ReviewRepository;
use Nurdaulet\FluxBase\Repositories\RatingRepository;

class ReviewService
{
    public function __construct(
        private ReviewRepository $reviewRepository,
        private RatingRepository $ratingRepository
    )
    {
    }

    public function create($user, $reviewable, $data)
    {
        $data['user_id'] = $user->id;
        $data['rating_id'] = $this->ratingRepository->getByValue($data['rating'])->id;
        $review = $this->reviewRepository->create($reviewable, $data);

        if (!empty($data['rating_messages'])) {
            $review->messages()->sync($data['rating_messages']);
        }
        $review->load(['rating', 'messages']);

        return $review;
    }

    public function skip($user, $reviewable)
    {
        $data = [
            'user_id' => $user->id,
            'is_skipped' => true
        ];
        $this->reviewRepository->create($reviewable, $data);
    }

    public function list($reviewable)
    {
        return $this->reviewRepository->getByReviewable($reviewable);
    }
}
