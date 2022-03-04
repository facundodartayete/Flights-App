<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Flight;
use Illuminate\Validation\ValidationException;

class FlightController extends Controller
{

    public function index()
    {
        return view('flights.index');
    }

    public function getFlights()
    {
        return Flight::with(['destination_city', 'origin_city', 'airline'])->paginate(10);
    }

    public function store()
    {
        return Flight::create($this->validateFlight());
    }

    public function update(Flight $flight)
    {
        $flightRequest = $this->validateFlight($flight);
        $flight->airline_id = $flightRequest['airline_id'];
        $flight->origin_city_id = $flightRequest['origin_city_id'];
        $flight->destination_city_id = $flightRequest['destination_city_id'];
        $flight->departure_at = $flightRequest['departure_at'];
        $flight->arrival_at = $flightRequest['arrival_at'];
        $flight->save();
        return ['flight' => $flight];
    }

    protected function validateFlight(?Flight $flight = null): array
    {
        $flight ??= new Flight();
        $requestArray =  request()->validate([
            'airline_id' => 'required|exists:airlines,id',
            'origin_city_id' => 'required|exists:cities,id',
            'destination_city_id' => 'required|exists:cities,id',
            'departure_at' => 'required|date',
            'arrival_at' => 'required|date',
        ]);

        if ($requestArray['origin_city_id'] == $requestArray['destination_city_id'])
            throw ValidationException::withMessages(['origin_city_id' => 'Origin and Destination must be different cities']);

        if ($requestArray['departure_at'] >= $requestArray['arrival_at'])
            throw ValidationException::withMessages(['departure_at' => 'Arrival cannot happen bedore departure']);

        $airline = Airline::find($requestArray['airline_id']);
        if (!$airline->cities()->where('cities.id', $requestArray['origin_city_id'])->exists())
            throw ValidationException::withMessages(['origin_city_id' => "{$airline->name} does not have a route to the selected city"]);

        if (!$airline->cities()->where('cities.id', $requestArray['destination_city_id'])->exists())
            throw ValidationException::withMessages(['origin_city_id' => "{$airline->name} does not have a route to the selected city"]);

        return $requestArray;
    }

    public function delete(Flight $flight)
    {
        $flight->delete();
        return [];
    }
}
