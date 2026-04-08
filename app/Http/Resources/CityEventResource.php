<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityEventResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'title' => $this->title,
            'place' => $this->place,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'tags' => $this->tags,
            'capacity' => $this->capacity,
            'status' => $this->status,
            'popularity' => $this->popularity,
            'change_number' => $this->change_number,
        ];
    }
}
