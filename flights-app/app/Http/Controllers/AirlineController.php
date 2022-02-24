<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\City;
use Illuminate\Validation\Rule;

class AirlineController extends Controller
{
    public function index()
    {
        return view('airlines.index', [
            'cities' => City::orderBy('name')->get()
        ]);
    }

    public function getAirlines()
    {
        return Airline::withCount(['flights'])->paginate(10);
    }

    public function store()
    {
        return Airline::create($this->validateAirline());
    }

    public function update(Airline $airline)
    {
        $airlineRequest = $this->validateAirline($airline);
        $airline->name = $airlineRequest['name'];
        $airline->business_description = $airlineRequest['business_description'];

        $cities = City::find($airlineRequest['city_ids']);
        $airline->cities()->sync($cities);

        $airline->save();
        return ['airline' => $airline];
    }

    public function updateCities(Airline $airline)
    {
        $airlineRequest = request()->validate([
            'city_ids' => 'array',
            'city_ids.*' => 'int'
        ]);

        $cities = City::find($airlineRequest['city_ids']);
        $airline->cities()->sync($cities);

        $airline->save();
        return ['airline' => $airline];
    }

    protected function validateAirline(?Airline $airline = null): array
    {
        $airline ??= new Airline();

        return request()->validate([
            'name' => ['required', Rule::unique('airlines', 'name')->ignore($airline)],
            'business_description' => 'required',
            /*     'city_ids' => 'array',
            'city_ids.*' => 'int' */
        ]);
    }

    public function delete(Airline $airline)
    {
        $airline->delete();
        return [];
    }
}
