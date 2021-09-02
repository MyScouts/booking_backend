<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';

    protected $fillable = [
        "id",
        "name",
        "description",
        "phone_number",
        "address",
        "open_time",
        "close_time",
        "rating",
        "medium_price",
        "unit",
        "post_code",
        "information",
        "delete_at",
    ];
}
