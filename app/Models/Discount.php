<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', '
        type', 
        'price', 
        'promo_start_date', 
        'promo_expire_date', 
        'promo_code'
    ];

    public function bookings()
    {
        return $this->hasMany(BookingDetails::class);
    }
}
