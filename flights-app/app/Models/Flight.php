<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = [];

    public function destination_city()
    {
        return $this->belongsTo(City::class, 'destination_city_id');
    }

    public function origin_city()
    {
        return $this->belongsTo(City::class, 'origin_city_id');
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }
}
