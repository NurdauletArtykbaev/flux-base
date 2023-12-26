<?php

namespace Nurdaulet\FluxBase\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LayoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type,
            'slug' => $this->slug,
            'text' => $this->text,
            'fields' => $this->fields
        ];
    }
}
