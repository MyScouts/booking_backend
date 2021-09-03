<?php

namespace App\Http\Controllers\Api\v1\Booking;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\BookingCollection;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class UserBookingController extends Controller
{

    protected $service;
    /**
     * __construct
     *
     * @param  BookingService $service
     * @return void
     */
    public function __construct(BookingService $service)
    {
        $this->service = $service;
    }

    /**
     * get my booking
     *
     * @param  mixed $request
     * @return void
     */
    public function myBooking(Request $request)
    {
        $validator = $this->searchValidator($request);
        if ($validator->fails()) {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, $validator->messages(), false);
        }

        // result
        $bookings = $this->service->getBookingByUserId($this->getUser()->id, (int) $request->pageSize);
        return ResponseHelper::responseCallback(Response::HTTP_OK, 'successfull!', true, new BookingCollection($bookings));
    }

    /**
     * create my booking
     *
     * @param  mixed $request
     * @return void
     */
    public function createBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id'          => 'required|numeric',
            'check_in_date'     => 'required|date|after_or_equal:now',
            'check_out_date'    => 'required|date|after_or_equal:check_in_date',
            'rooms'             => 'required|array|min:1',
            'rooms.*.room_id'   => 'required|numeric',
            'rooms.*.price'     => 'required|numeric',
            'rooms.*.unit'      => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, $validator->messages(), false);
        }
        $bookingEntity = [
            'user_id'           => auth()->user()->id,
            'hotel_id'          => $request->hotel_id,
            'check_in_date'     => $request->check_in_date,
            'check_out_date'    => $request->check_out_date,
            'rooms'             => $request->rooms
        ];
        $booking = $this->service->getInsert($bookingEntity);
        if (!$booking) {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'Booking create fails!', false);
        }

        return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'Booking create success!', true, new BookingResource($booking));
    }
}
