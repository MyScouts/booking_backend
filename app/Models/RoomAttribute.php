<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAttribute extends Model
{
    use HasFactory;
    protected $table = 'room_attributes';

    protected $fillable = [
        'room_id',
        'image_path',
        'description',
        'like',
        'deleted_at'
    ];
}
