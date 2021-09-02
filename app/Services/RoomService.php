<?php

namespace App\Services;

use App\Responsitory\RoomResponsitory;

class RoomService extends BaseService
{
    protected $respon;
    public function __construct(RoomResponsitory $respon)
    {
        $this->respon = $respon;
    }

    public function getAllRoom($condiction = [], $select = [])
    {
        return $this->respon->selectAllRoom($condiction, $select);
    }
}
