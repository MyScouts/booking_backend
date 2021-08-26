<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    use HasFactory;

    protected $table = 'devices';


    protected $fillable = [
        'user_id',
        'active',
        'device_token',
        'device_id',
        'device_type'
    ];
}
