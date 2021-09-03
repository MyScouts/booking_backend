<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
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
            'items'          => BookingResource::collection($this->collection),
        ];
    }
}
