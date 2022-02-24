<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airline extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'business_description'];

    public function flights()
    {
        return $this->hasMany(Flight::class, 'airline_id');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }

}
