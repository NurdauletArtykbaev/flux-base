<?php

namespace Nurdaulet\FluxBase\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'name' => (string)$this->name,
            'cities' => CitiesResource::collection($this->whenLoaded('cities')),
            'icon' => $this->icon ? config('filesystems.disks.s3.url').'/'.$this->icon : null,
        ];
    }
}
