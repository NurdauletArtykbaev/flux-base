<?php

namespace Nurdaulet\FluxBase\Http\Resources\v2\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'rating' => $this->rating,
            'messages' => RatingMessageResource::collection($this->whenLoaded('messages'))
        ];
    }
}
