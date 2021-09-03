<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'user_id' => $this->user_id,
            'hotel_id' => $this->hotel_id,
            'check_in_date' => $this->check_in_date,
            'check_out_date' => $this->check_out_date,
            'deleted_at' => $this->deleted_at,
            'create_user_id' => $this->create_user_id,
            'update_user_id' => $this->update_user_id,
            'accept_time' => $this->accept_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'booking_details'  => $this->bookingDetails
        ];
    }
}
