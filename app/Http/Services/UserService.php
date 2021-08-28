<?php

namespace App\Http\Services;

use App\Http\Responsitory\UserResponsitory;
use Log;

class UserService
{
    protected $responsitory;
    public function __construct(UserResponsitory $responsitory)
    {
        $this->responsitory = $responsitory;
    }

    public function selectUpdate($condiction = [], $update = [])
    {
        Log::info("User Service", [$condiction, $update]);
        return $this->responsitory->update($condiction, $update);
    }

    public function checkClient($where = array())
    {
        return $this->responsitory->checkClient($where);
    }
}
