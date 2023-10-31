<?php

namespace Nurdaulet\FluxBase\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannersResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'sort' => $this->sort,
            'image' => $this->image ? (config('filesystems.disks.s3.url') . '/' . $this->image) : null,
            'user_id' => $this->user_id,
            'catalog' => new CategoriesResource($this->whenLoaded('catalog'))
        ];

    }
}
