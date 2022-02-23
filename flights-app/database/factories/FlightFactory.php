<?php

namespace Database\Factories;

use App\Models\Airline;
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
            'airline_id' => Airline::factory(),
            'origin_city_id' => City::factory(),
            'destination_city_id' => City::factory(),
            'departure_at' => $departureAt,
            'arrival_at' =>  $this->faker->dateTimeBetween($departureAt, strtotime('+12 hours', $departureAt->format('U'))),
        ];
    }
}
