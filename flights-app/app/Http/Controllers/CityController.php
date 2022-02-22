<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    public function index()
    {
        return view('cities.index', [
            'cities' => City::all()
        ]);
    }

}
