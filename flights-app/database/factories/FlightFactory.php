<?php

namespace Database\Factories;

use App\Models\Airline;
use App\Models\AirlineCity;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $departureAt =  $this->faker->dateTimeBetween('+0 days', '+1 years');

        $airline = Airline::factory()->create();
        $origin = City::factory()->create();
        $destination = City::factory()->create();

        AirlineCity::factory()->create([
            'airline_id' => $airline->id,
            'city_id' => $origin->id,
        ]);
        AirlineCity::factory()->create([
            'airline_id' => $airline->id,
            'city_id' => $destination->id,
        ]);

        return [
            'airline_id' => $airline,
            'origin_city_id' => $origin,
            'destination_city_id' => $destination,
            'departure_at' => $departureAt,
            'arrival_at' =>  $this->faker->dateTimeBetween($departureAt, strtotime('+12 hours', $departureAt->format('U'))),
        ];
    }
}
