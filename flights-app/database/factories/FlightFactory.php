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

        return [
            'departure_at' => $departureAt,
            'arrival_at' =>  $this->faker->dateTimeBetween($departureAt, strtotime('+12 hours', $departureAt->format('U'))),
        ];
    }

    public function route($airline, $origin, $destination)
    {
        if (!AirlineCity::where(['airline_id' => $airline->id, 'city_id' => $origin->id])->count()) {
            AirlineCity::factory()->create([
                'airline_id' => $airline->id,
                'city_id' => $origin->id,
            ]);
        }
        if (!AirlineCity::where(['airline_id' => $airline->id, 'city_id' => $destination->id])->count()) {
            AirlineCity::factory()->create([
                'airline_id' => $airline->id,
                'city_id' => $destination->id,
            ]);
        }

        return $this->state(function ($attributes) use ($airline, $origin, $destination) {
            return [
                'airline_id' => $airline->id,
                'origin_city_id' => $origin->id,
                'destination_city_id' => $destination->id,
            ];
        });
    }

    public function newRandomRoute()
    {
        $airline = Airline::factory()->create();
        $cities = City::factory(2)->create();
        $origin = $cities[0];
        $destination = $cities[1];

        AirlineCity::factory()->create([
            'airline_id' => $airline->id,
            'city_id' => $origin->id,
        ]);
        AirlineCity::factory()->create([
            'airline_id' => $airline->id,
            'city_id' => $destination->id,
        ]);
        AirlineCity::factory()->create([
            'airline_id' => $airline->id,
            'city_id' => $origin->id,
        ]);
        AirlineCity::factory()->create([
            'airline_id' => $airline->id,
            'city_id' => $destination->id,
        ]);

        return $this->state(function ($attributes) use ($airline, $origin, $destination) {
            return [
                'airline_id' => $airline->id,
                'origin_city_id' => $origin->id,
                'destination_city_id' => $destination->id,
            ];
        });
    }
}
