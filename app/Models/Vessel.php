<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;
    protected $table = "vessels";
    protected $fillable = [
        'accomodation_id',
        'vessel_name',
        'cottage_num'
    ];

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
