<?php

namespace App\Http\Services;

use App\Http\Responsitory\UserResponsitory;

class UserService
{
    protected $responsitory;
    public function __construct(UserResponsitory $responsitory)
    {
        $this->responsitory = $responsitory;
    }

    public function selectUpdate($condiction = [], $update = [])
    {
        return $this->responsitory->update($condiction, $update);
    }
}
