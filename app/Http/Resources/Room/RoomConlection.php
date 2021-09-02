<?php

namespace App\Http\Resources\Room;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoomConlection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "total"          => $this->total(),
            "last_page"      => $this->lastPage(),
            "current_page"   => $this->currentPage(),
            "per_page"       => $this->perPage(),
            'items'          => RoomResource::collection($this->collection),
        ];
    }
}
