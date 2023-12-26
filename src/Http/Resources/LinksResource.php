<?php

namespace Nurdaulet\FluxBase\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinksResource extends JsonResource
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
            'text' => (string)$this->text,
            'image' => $this->image ? config('filesystems.disks.s3.url') . '/' . $this->image : null,
            'link' => (string)$this->link,
        ];
    }
}
