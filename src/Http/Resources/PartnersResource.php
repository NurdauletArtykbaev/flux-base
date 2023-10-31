<?php

namespace Nurdaulet\FluxBase\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnersResource extends JsonResource
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
            'id' => $this->partner->id,
            'name' => $this->partner->name,
            'surname' => $this->partner->surname,
            'company_name' => $this->partner->company_name,
            'avg_rating' => $this->partner->avg_rating,
            'image_url' => $this->image_url,
            'webp_url' => $this->webp_url,
            'logo_url' => $this->logo_url,
            'logo_webp_url' => $this->logo_webp_url,
        ];
    }
}
