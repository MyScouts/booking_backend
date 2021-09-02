<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelAttribute extends Model
{
    use HasFactory;

    protected $table = 'hotel_attributes';

    protected $fillable = [
        'hotel_id',
        'image_path',
        'description',
        'like',
    ];
}
