<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Flight;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $cities = City::factory(20)->create();
        $airlines = Airline::factory(10)->create();

        foreach ($cities as $city) {
            for ($i = 0; $i < rand(0, 12); $i++) {
                $airlineIndex = rand(0, count($airlines) - 1);
                $destinationCityIndex = rand(0, count($cities) - 1);
                //TODO: crear las airline_cities correspondientes

                Flight::factory()->create([
                    'airline_id' => $airlines[$airlineIndex]->id,
                    'origin_city_id' => $city->id,
                    'destination_city_id' => $cities[$destinationCityIndex]->id,
                ]);
            }
        }
    }
}
