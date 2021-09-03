<?php
namespace App\Responsitory;
use App\Models\Hotel;
use App\Responsitory\BaseResponsitory;

class HotelResponsitory extends BaseResponsitory
{

    public function selectById($id)
    {
        $hotel = Hotel::with('rooms')->find($id);

        return $hotel;
    }

    public function selectCheckRoomExist($hotelId, $roomId)
    {
        $exist = Hotel::find($hotelId)->rooms()->find($roomId);

        if ($exist->exists()) {
            return true;
        }

        return false;
    }
}
