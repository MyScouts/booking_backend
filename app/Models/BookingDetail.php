<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $table = 'booking_details';
    protected $fillable = [
        'room_id',
        'booking_id',
        'price',
        'unit',
        'deleted_at',
        'create_user_id',
        'update_user_id'
    ];
}
