<?php

namespace App\Http\Resources\Room;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'hotel_id'          => $this->id,
            'price'             => $this->price,
            'unit'              => $this->unit,
            'room_id'           => $this->room_id,
            'description'       => $this->description,
            'rating'            => $this->rating,
            'people_of_room'    => $this->people_of_room,
            'total_bed'         => $this->total_bed,
            'category'          => $this->category,
            'deleted_at'        => $this->deleted_at,
            'create_user_id'    => $this->create_user_id,
            'update_user_id'    => $this->update_user_id,
            'attributes'         => $this->attributes,
        ];
    }
}
