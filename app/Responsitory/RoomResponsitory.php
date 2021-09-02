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
}
