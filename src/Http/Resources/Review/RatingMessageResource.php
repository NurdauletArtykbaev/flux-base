<?php

namespace Nurdaulet\FluxBase\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'message'   => $this->message,
        ];
    }
}
