<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $table = "accommodations";
    protected $fillable = [
        "vessel_id",
        "accommodation_name",
        "image_path",
        "cottage_qy"
    ];
    
    public function vessels()
    {
        return $this->belongsTo(Vessel::class);
    }
    // public function fare()
    // {
    //     return $this->belongsTo(Fare::class);
    // }
}
