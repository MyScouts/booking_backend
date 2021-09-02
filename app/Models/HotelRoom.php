<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;

    protected $table = 'hotel_rooms';

    protected $fillable = [
        'hotel_id',
        'price',
        'unit',
        'room_id',
        'description',
        'rating',
        'people_of_room',
        'total_bed',
        'category',
        'deleted_at',
        'create_user_id',
        'update_user_id',
    ];
}
