<?php

namespace App\Responsitory;

use App\Domains\Auth\Models\User;
use App\Models\Booking;
use App\Responsitory\BaseResponsitory;
use Auth;
use DB;
use Log;

class BookingResponsitory extends BaseResponsitory
{

    protected $room;
    protected $bookingDetail;

    /**
     * __construct
     *
     * @param  RoomResponsitory $room
     * @param  BookingDetailReponsitory $bookingDetail
     * @return void
     */
    public function __construct(RoomResponsitory $room, BookingDetailReponsitory $bookingDetail)
    {
        $this->room = $room;
        $this->bookingDetail = $bookingDetail;
    }

    /**
     * insert booking to database
     *
     * @param  array $input
     * @return Booking
     */
    public function selectInsert($input): Booking
    {
        $entity = [
            'user_id'           => $input['user_id'],
            'create_user_id'    => $input['user_id'],
            'update_user_id'    => $input['user_id'],
            'hotel_id'          => $input['hotel_id'],
            'check_in_date'     => $input['check_in_date'],
            'check_out_date'    => $input['check_out_date'],
        ];

        DB::beginTransaction();
        try {
            $bookingId = Booking::insertGetId($entity);
            $roomIds = [];
            foreach ($input['rooms'] as $room) {
                array_push($roomIds, $room['room_id']);
            }
            $checkRoomExists = $this->room->selectRoomIsValid($roomIds, $input['hotel_id']);
            if ($checkRoomExists == count($roomIds)) {
                foreach ($input['rooms'] as $room) {
                    $this->bookingDetail->selectInsert([
                        'room_id' => $room['room_id'],
                        'booking_id' => $bookingId,
                        'price' => $room['price'],
                        'unit' => $room['unit'],
                        'user_id' => $input['user_id'],
                    ]);
                }
                DB::commit();
                $booking = $this->selectBookingById($bookingId);
                return $booking;
            }
        } catch (\Throwable $th) {
            Log::error('Booking', ['error' => $th->getMessage()]);
            DB::rollBack();
        }

        return false;
    }

    /**
     * select booking by id
     *
     * @param  integer $id
     * @return Booking
     */
    public function selectBookingById($id): Booking
    {
        $booking = Booking::where('id', $id)->first();

        return $booking;
    }


    /**
     * select booking by user id
     *
     * @param  integer $userId
     * @return void
     */
    public function selectBookingByUserId($userId, $pageSize = null)
    {
        $bookings = Booking::where('user_id', '=', $userId)
            ->paginate($pageSize ?? self::PAGE_SIZE);

        return $bookings;
    }
}
