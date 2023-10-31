<?php

namespace Nurdaulet\FluxBase\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintReasonsResource extends JsonResource
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
            'is_for_user' => $this->is_for_user,
        ];
    }
}
