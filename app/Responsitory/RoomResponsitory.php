<?php

namespace App\Responsitory;

use App\Models\HotelRoom;

class RoomResponsitory extends BaseResponsitory
{

    public function selectAllRoom($condiction = [], $select = [])
    {
        $rooms = HotelRoom::with('attributes')
            ->whereNull('deleted_at')
            ->paginate();

        return $rooms;
    }

    public function selectRoomIsValid($roomIds = [], $hotelId)
    {
        $count = HotelRoom::whereIn('id', $roomIds)
            ->whereNull('deleted_at')
            ->where('hotel_id', $hotelId)
            ->count();

        return $count;
    }
}
