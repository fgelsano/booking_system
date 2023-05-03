<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = "schedules";
    protected $fillable = [
        "vessel_id",
        "origin",
        "destination",
        "departure_date",
        "departure_date_range",
        "departure_time",  
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }
    
}
