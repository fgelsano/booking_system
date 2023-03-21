<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $table = "accomodations";
    protected $fillable = [
        "fare_id",
        "accomodation_name",
        "accomodation_type",
        "cottage_qy"
    ];
    
    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }
    public function fare()
    {
        return $this->belongsTo(Fare::class);
    }
}
