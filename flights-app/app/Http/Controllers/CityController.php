<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    public function index()
    {
        return view('cities.index', [
            'cities' => City::withCount(['flights_arriving', 'flights_departing',])->paginate(10)
        ]);
    }
    public function store()
    {
        City::create($this->validateCity());
        return back();
    }

    public function update(City $city)
    {
        $cityRequest = $this->validateCity();
        $city->name = $cityRequest['name'];
        $city->save();
        return $city;
    }

    protected function validateCity(?City $city = null): array
    {
        $city ??= new City();

        return request()->validate([
            'name' => ['required', Rule::unique('cities', 'name')->ignore($city)],
        ]);
    }

    public function delete(City $city)
    {
        $city->delete();
    }

}
