<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', ];

    public function flights_arriving()
    {
        return $this->hasMany(Flight::class, 'destination_city_id');
    }

    public function flights_departing()
    {
        return $this->hasMany(Flight::class, 'origin_city_id');
    }

    public function airlines()
    {
        return $this->belongsToMany(Airline::class, 'airline_cities');
    }

}
