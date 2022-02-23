<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Validation\Rule;

class AirlineController extends Controller
{
    public function index()
    {
        return view('airlines.index', [
            'airlines' => $this->getAirlines()
        ]);
    }

    public function updatedTable()
    {
        return view('airlines._airlines-table', [
            'airlines' => $this->getAirlines()
        ])->render();
    }

    public function getAirlines()
    {
        return  Airline::withCount(['flights'])->paginate(10);
    }

    public function store()
    {
        Airline::create($this->validateAirline());
        return back();
    }

    public function update(Airline $airline)
    {
        $airlineRequest = $this->validateAirline();
        $airline->name = $airlineRequest['name'];
        $airline->business_description = $airlineRequest['business_description'];
        $airline->save();
        return $airline;
    }

    protected function validateAirline(?Airline $airline = null): array
    {
        $airline ??= new Airline();

        return request()->validate([
            'name' => ['required', Rule::unique('airlines', 'name')->ignore($airline)],
            'business_description' => 'required',
        ]);
    }

    public function delete(Airline $airline)
    {
        $airline->delete();
    }
}
