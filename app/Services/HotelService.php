<?php
namespace App\Services;
use App\Responsitory\HotelResponsitory;

class HotelService
{
    protected $repons;
    public function __construct(HotelResponsitory $repons)
    {
        $this->repons = $repons;
    }

    public function getDetail($id)
    {
        return $this->repons->selectById($id);
    }
}
