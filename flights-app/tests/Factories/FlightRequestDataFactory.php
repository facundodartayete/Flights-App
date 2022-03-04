<?php

namespace Tests\Factories;

use App\Models\Flight;
use DateTime;

class FlightRequestDataFactory
{
    private int $airline_id = 1;
    private int $origin_city_id = 1;
    private int $destination_city_id = 2;
    private string $departure_at = '2022-01-01 15:03:01';
    private string $arrival_at = '2022-01-01 19:03:01';

    public static function new(): self
    {
        return new self();
    }

    public function create(array $extra = []): array
    {
        return $extra + [
            'airline_id' => $this->airline_id,
            'origin_city_id' => $this->origin_city_id,
            'destination_city_id' => $this->destination_city_id,
            'departure_at' => $this->departure_at,
            'arrival_at' => $this->arrival_at
        ];
    }

    public function withAirlineId(int $airline_id): self
    {
        $clone = clone $this;
        $clone->airline_id = $airline_id;
        return $clone;
    }

    public function withFlight(Flight $flight): self
    {
        $clone = clone $this;

        $clone->airline_id = $flight->airline_id;
        $clone->origin_city_id = $flight->origin_city_id;
        $clone->destination_city_id = $flight->destination_city_id;
        $clone->departure_at = $flight->departure_at->format('Y-m-d H:i:s');
        $clone->arrival_at = $flight->arrival_at->format('Y-m-d H:i:s');

        return $clone;
    }
}
