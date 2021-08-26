<?php

namespace App\Http\Responsitory;

use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserResponsitory extends BaseResponsitory
{
    public function update($condiction = [], $update = [])
    {
        DB::beginTransaction();
        try {
            User::where($condiction)
                ->update($update);
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th);
            throw $th;
        }
        return false;
    }

    public function checkClient($where = array())
    {
        return DB::table('oauth_clients')->where($where)->first();
    }
}
