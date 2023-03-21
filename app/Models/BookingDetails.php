<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_id',
        'accommodation_id',
        'discount_id',
        'passenger_type',
        'VAT'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
