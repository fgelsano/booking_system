<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    use HasFactory;
    protected $table = "fares";
    protected $fillable = [
        "fare_name",
        "price"
    ];
    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }
}
