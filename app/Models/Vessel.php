<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;
    protected $table = "vessels";
    protected $fillable = [
        'vessel_name',
        'vessel_capacity'
    ];

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
