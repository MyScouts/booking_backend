<?php

namespace App\Responsitory;

use App\Models\BookingDetail;
use App\Responsitory\BaseResponsitory;
use DB;
use Log;

class BookingDetailReponsitory extends BaseResponsitory
{
    protected $room;
    public function __construct(RoomResponsitory $room)
    {
        $this->room = $room;
    }

    public function selectInsert($input)
    {
        $entity = [
            'room_id'           => $input['room_id'],
            'booking_id'        => $input['booking_id'],
            'price'             => $input['price'],
            'unit'              => $input['unit'],
            'create_user_id'    => $input['user_id'],
            'update_user_id'    => $input['user_id']
        ];
        try {
            DB::beginTransaction();
            BookingDetail::insert($entity);
            DB::commit();
            return false;
        } catch (\Throwable $th) {
            Log::error('Booking Detail', ['message' => $th->getMessage()]);
            DB::rollBack();
        }
        return false;
    }
}
