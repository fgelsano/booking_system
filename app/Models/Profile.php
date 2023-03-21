<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = "profiles";
    protected $fillable = [
        "user_id",
        "firstname",
        "lastname",
        "age",
        "address",
        "contact",
        "email"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function staffBookings()
    {
        return $this->hasMany(Booking::class, 'staff_id');
    }

    public function customerBookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }
}
