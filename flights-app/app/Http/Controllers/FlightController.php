<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Exception;

class FlightController extends Controller
{
    public function index()
    {
        return view('flights.index');
    }

    public function getFlights()
    {
        return Flight::with(['destination_city', 'origin_city_id', 'airline'])->paginate(10);
    }

    public function store()
    {
        return Flight::create($this->validateFlight());
    }

    public function update(Flight $flight)
    {
        //TODO: dont require every fields
        $flightRequest = $this->validateFlight($flight);
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

        //TODO: exception types
        if ($requestArray['origin_city_id'] == $requestArray['destination_city_id'])
            throw new Exception('Origin and Destination must be different cities');

        if ($requestArray['departure_at'] >= $requestArray['arrival_at'])
            throw new Exception('Arrival cannot happen bedore departure');

        return $requestArray;
    }

    public function delete(Flight $flight)
    {
        $flight->delete();
        return [];
    }
}
