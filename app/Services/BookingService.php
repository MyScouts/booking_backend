<?php

namespace App\Services;

use App\Responsitory\BookingResponsitory;

class BookingService
{
    protected $respons;
    public function __construct(BookingResponsitory $respons)
    {
        $this->respons = $respons;
    }

    public function getInsert($entity = [])
    {
        return $this->respons->selectInsert($entity);
    }
    public function getBookingById($id)
    {
        return $this->respons->selectBookingById($id);
    }

    public function getBookingByUserId($userId, $pageSize = null)
    {
        return $this->respons->selectBookingByUserId($userId, $pageSize);
    }
}
